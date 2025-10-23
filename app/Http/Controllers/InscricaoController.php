<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoColaborador;
use App\Models\InscricaoVoluntario;

class InscricaoController extends Controller
{
    public function storeColab(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:inscricoes_colaboradores,email',
            'telefone' => 'nullable|string|max:50',
            'unidade' => 'required|string',
            'diretoria' => 'required|string',
            'unidade_escolha_comercial' => 'nullable|string',
            'transporte_caieiras' => 'nullable|string',
            'transporte_pirai' => 'nullable|string',
            'rota_pirai' => 'nullable|string',
            'dependentes_qtd' => 'nullable|integer|min:0|max:6',
            'convidados.*.nome' => 'required|string|max:255',
            'convidados.*.nascimento' => 'required|date',
            'convidados.*.rg' => 'nullable|string|max:50',
            'convidados.*.parentesco' => 'required|string',
            'convidados.*.email' => 'nullable|email|max:255',
            'convidados.*.autorizacao' => 'nullable|string'
        ], [
            'nome.required' => 'O campo Nome do colaborador é obrigatório.',
            'email.email' => 'O e-mail do colaborador deve ser válido.',
            'email.unique' => 'Este e-mail já foi utilizado em uma inscrição.',
            'unidade.required' => 'Selecione a unidade de trabalho.',
            'diretoria.required' => 'Selecione a diretoria.',
            'dependentes_qtd.integer' => 'Informe a quantidade de dependentes (1 a 6).',
            'dependentes_qtd.min' => 'Informe pelo menos 0 dependentes.',
            'dependentes_qtd.max' => 'O máximo permitido é 6 dependentes.',
            'convidados.*.nome.required' => 'O nome do convidado é obrigatório.',
            'convidados.*.nascimento.required' => 'Informe a data de nascimento do convidado.',
            'convidados.*.parentesco.required' => 'Selecione o grau de parentesco do convidado.',
            'convidados.*.email.email' => 'O e-mail do convidado deve ser válido.'
        ]);

        $unidadeParaContagem = $request->unidade;

        if ($request->unidade === 'Vila Olímpia' && $request->filled('unidade_escolha_comercial')) {
            $unidadeParaContagem = $request->unidade_escolha_comercial;
        }

        $totalUnidade = InscricaoColaborador::where(function ($query) use ($request, $unidadeParaContagem) {
            if ($request->unidade === 'Vila Olímpia') {
                $query->where('unidade', 'Vila Olímpia')
                    ->where('unidade_escolha_comercial', $unidadeParaContagem);
            } else {
                $query->where('unidade', $unidadeParaContagem);
            }
        })->count();

        if ($totalUnidade >= 135) {
            return redirect()->back()->withErrors([
                'unidade' => "O limite de 135 inscrições para {$unidadeParaContagem} já foi atingido."
            ])->withInput();
        }

        $colaborador = InscricaoColaborador::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'unidade' => $request->unidade,
            'diretoria' => $request->diretoria,
            'unidade_escolha_comercial' => $request->unidade_escolha_comercial,
            'transporte_caieiras' => $request->transporte_caieiras,
            'transporte_pirai' => $request->transporte_pirai,
            'rota_pirai' => $request->rota_pirai
        ]);

        if ($request->has('convidados')) {
            foreach ($request->convidados as $convidado) {
                $colaborador->dependentes()->create($convidado);
            }
        }

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    public function storeVolun(Request $request) {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|unique:inscricoes_voluntarios,email',
            'phone'          => 'required|string|max:20',
            'shirt_size'     => 'required|in:P,M,G,GG',
            'unit'           => 'required|in:Anápolis,Caieiras,Mogi das Cruzes,Piraí,Vila Olímpia',
            'support_unit'   => 'nullable|in:Caieiras,Mogi das Cruzes',
            'terms_accepted' => 'accepted'
        ], [
            'full_name.required'      => 'Por favor, informe seu nome completo.',
            'full_name.max'           => 'O nome completo não pode ultrapassar 255 caracteres.',
            'email.required'          => 'Informe seu e-mail corporativo.',
            'email.email'             => 'Informe um e-mail válido.',
            'email.unique'            => 'Este e-mail já foi utilizado em uma inscrição.',
            'phone.required'          => 'Informe seu telefone para contato.',
            'phone.max'               => 'O número de telefone não pode ultrapassar 20 caracteres.',
            'shirt_size.required'     => 'Selecione o tamanho da camiseta.',
            'shirt_size.in'           => 'Selecione um tamanho de camiseta válido.',
            'unit.required'           => 'Selecione sua unidade de trabalho.',
            'unit.in'                 => 'Selecione uma unidade válida.',
            'support_unit.in'         => 'Selecione uma unidade válida para apoio.',
            'terms_accepted.accepted' => 'Você precisa aceitar o termo de compromisso para continuar.'
        ]);

        $unidadeParaContagem = $request->unit;

        if ($request->unit === 'Vila Olímpia' && $request->filled('support_unit')) {
            $unidadeParaContagem = $request->support_unit;
        }

        $totalUnidade = InscricaoVoluntario::where(function ($query) use ($request, $unidadeParaContagem) {
            if ($request->unit === 'Vila Olímpia') {
                $query->where('unit', 'Vila Olímpia')
                    ->where('support_unit', $unidadeParaContagem);
            } else {
                $query->where('unit', $unidadeParaContagem);
            }
        })->count();
            
        if ($totalUnidade >= 1) {
            return redirect()->back()->withErrors([
                'unit' => "O limite de 15 inscrições para {$unidadeParaContagem} já foi atingido."
            ])->withInput();
        }

        InscricaoVoluntario::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shirt_size' => $request->shirt_size,
            'unit' => $request->unit,
            'support_unit' => $request->support_unit,
            'terms_accepted' => true
        ]);

        return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
