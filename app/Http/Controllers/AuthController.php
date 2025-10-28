<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\InscricaoColaborador;
use App\Models\InscricaoVoluntario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view ('login.index');
    }

    public function logar(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email|string',
            'password' => 'required|string'
        ], [
            'email.email'       => 'O e-mail deve ser válido.',
            'email.required'    => 'O e-mail é obrigatório.',
            'password.required' => 'A senha é obrigatória.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')
                ->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais não correspodem com nenhum usuário.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login');
    }

    private function unidadeContabilizada($unidade, $diretoria, $unidadeEscolhaComercial, $unidadeEscolhaComercialVO)
    {
        $unidadeLower = strtolower($unidade);
        $diretoriaLower = strtolower($diretoria);

        $isComercial = str_contains($diretoriaLower, 'comercial');
        $isVilaOlimpia = $unidadeLower === 'vila olímpia' || $unidadeLower === 'vila olimpia';

        if ($isComercial && $isVilaOlimpia && $unidadeEscolhaComercialVO) {
            return $unidadeEscolhaComercialVO;
        } elseif ($isComercial && $unidadeEscolhaComercial) {
            return $unidadeEscolhaComercial;
        } elseif ($isVilaOlimpia && $unidadeEscolhaComercialVO) {
            return $unidadeEscolhaComercialVO;
        }

        return $unidade;
    }

    private function unidadeContabilizadaVoluntario($unit, $supportUnit)
    {
        $unitLower = strtolower($unit);
        $supportUnitLower = strtolower($supportUnit ?? '');

        if (!empty($supportUnitLower)) {
            return $supportUnit;
        }

        return $unit;
    }

    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        $colaboradoresCollection = InscricaoColaborador::query()
            ->when($search, fn($q) => $q->where('unidade', 'LIKE', "%{$search}%"))  
            ->get()
            ->map(function ($item) {
                $item->unidade_contabilizada = $this->unidadeContabilizada(
                    $item->unidade,
                    $item->diretoria,
                    $item->unidade_escolha_comercial,
                    $item->unidade_escolha_comercial_vo
                );
                $item->unidade_original = $item->unidade;
                return $item;
            })
            ->groupBy(fn($item) => $item->unidade_original . '|' . $item->unidade_contabilizada)
            ->map(fn($group) => (object)[
                'unidade_original' => $group->first()->unidade_original,
                'unidade_contabilizada' => $group->first()->unidade_contabilizada,
                'total' => $group->count()
            ])
            ->sortBy('unidade_contabilizada');

        $colaboradores = new LengthAwarePaginator(
            $colaboradoresCollection->forPage($request->input('colab_page', 1), 10),
            $colaboradoresCollection->count(),
            10,
            $request->input('colab_page', 1),
            ['path' => url()->current(), 'query' => $request->query()]
        );

        $voluntariosCollection = InscricaoVoluntario::query()
            ->when($search, fn($q) => $q->where('unit', 'LIKE', "%{$search}%"))
            ->get()
            ->map(function ($item) {
                $item->unidade_contabilizada = $this->unidadeContabilizadaVoluntario(
                    $item->unit,
                    $item->support_unit
                );
                $item->unidade_original = $item->unit;                
                return $item;
            })
            ->groupBy(fn($item) => $item->unidade_original . '|' . $item->unidade_contabilizada)
            ->map(fn($group) => (object)[
                'unidade_original' => $group->first()->unidade_original,
                'unidade_contabilizada' => $group->first()->unidade_contabilizada,
                'total' => $group->count()
            ])
            ->sortBy('unidade_contabilizada');

        $voluntarios = new LengthAwarePaginator(
            $voluntariosCollection->forPage($request->input('volun_page', 1), 10),
            $voluntariosCollection->count(),
            10,
            $request->input('volun_page', 1),
            ['path' => url()->current(), 'query' => $request->query()]
        );

        return view ('dashboard.index', compact('colaboradores', 'voluntarios', 'search'));
    }
}
