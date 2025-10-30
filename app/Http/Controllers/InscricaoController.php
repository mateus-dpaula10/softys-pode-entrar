<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoColaborador;
use App\Models\InscricaoVoluntario;
use App\Models\InscricaoDependente;
use App\Mail\InscricaoColaboradorMail;
use App\Mail\InscricaoVoluntarioMail;
use Illuminate\Support\Facades\Mail;

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
            'unidade_escolha_comercial_vo' => 'nullable|string',
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

        $unidade = strtolower($request->unidade);
        $diretoria = strtolower($request->diretoria);
        $isComercial = str_contains($diretoria, 'comercial');
        $isVilaOlimpia = $unidade === 'vila olímpia' || $unidade === 'vila olimpia';

        if ($isComercial) {
            $unidadeParaContagem = $request->unidade_escolha_comercial ?: $request->unidade;
        } elseif ($isVilaOlimpia) {
            $unidadeParaContagem = $request->unidade_escolha_comercial_vo ?: $request->unidade;
        } else {
            $unidadeParaContagem = $request->unidade;
        }
        
        $totalUnidade = InscricaoColaborador::withCount('dependentes')
            ->where(function($q) use ($unidadeParaContagem) {
                $q->where('unidade_escolha_comercial', $unidadeParaContagem)
                ->orWhere('unidade_escolha_comercial_vo', $unidadeParaContagem)
                ->orWhere('unidade', $unidadeParaContagem);
            })
            ->get()
            ->sum(fn($colab) => 1 + $colab->dependentes_count);

        $dependentesNovos = $request->has('convidados') ? count($request->convidados) : 0;
        $totalAposInclusao = $totalUnidade + 1 + $dependentesNovos;

        if ($totalAposInclusao >= 135) {
            return redirect()->back()->withErrors([
                'unidade' => "O limite de 135 participantes (colaboradores + dependentes) para {$unidadeParaContagem} já foi atingido."
            ])->withInput();
        }

        $colaborador = InscricaoColaborador::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'unidade' => $request->unidade,
            'diretoria' => $request->diretoria,
            'unidade_escolha_comercial' => $request->unidade_escolha_comercial,
            'unidade_escolha_comercial_vo' => $request->unidade_escolha_comercial_vo,
            'transporte_caieiras' => $request->transporte_caieiras,
            'transporte_pirai' => $request->transporte_pirai,
            'rota_pirai' => $request->rota_pirai
        ]);

        if ($request->has('convidados')) {
            foreach ($request->convidados as $convidado) {
                $autorizacao = null;

                if (!empty($convidado['aut_nome_responsavel'])) {
                    $autorizacao = "
                        Autorização de acompanhamento de menor

                        Eu, {$convidado['aut_nome_responsavel']}, portador(a) do CPF nº {$convidado['aut_cpf_responsavel']} e RG nº {$convidado['aut_rg_responsavel']}, na qualidade de responsável legal pelo(a) menor {$convidado['aut_nome_menor']}, nascido(a) em {$convidado['aut_data_menor']}, autorizo que o(a) Sr.(a) {$convidado['aut_nome_acomp']}, portador(a) do CPF nº {$convidado['aut_cpf_acomp']}, RG nº {$convidado['aut_rg_acomp']}, e que mantém a relação de {$convidado['aut_parentesco']}, acompanhe o menor durante o evento promovido pela empresa 'Pode Entrar'.

                        Declaro estar ciente de que:
                        1) A responsabilidade pela conduta do menor permanece sob minha inteira responsabilidade;
                        2) O acompanhante designado deverá zelar pela segurança, bem-estar e cumprimento das regras do evento;
                        3) Em caso de qualquer situação que coloque em risco a integridade do menor ou de terceiros, a empresa poderá determinar a retirada imediata do participante, sem prejuízo de outras medidas cabíveis.
                    ";
                }

                InscricaoDependente::create([
                    'inscricao_colaborador_id' => $colaborador->id,
                    'nome' => $convidado['nome'],
                    'nascimento' => $convidado['nascimento'],
                    'rg' => $convidado['rg'] ?? null,
                    'parentesco' => $convidado['parentesco'],
                    'email' => $convidado['email'] ?? null,
                    'autorizacao' => $autorizacao,
                ]);
            }
        }

        // Mail::to($colaborador->email)->send(new InscricaoColaboradorMail($colaborador));

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

        $unit = $request->unit;
        $supportUnit = $request->support_unit;

        $unidadeParaContagem = $unit === 'Vila Olímpia' && $supportUnit ? $supportUnit : $unit;

        $totalUnidade = InscricaoVoluntario::where(function ($q) use ($unidadeParaContagem) {
            $q->where('unit', $unidadeParaContagem)
            ->orWhere('support_unit', $unidadeParaContagem);
        })->count();
            
        if ($totalUnidade >= 15) {
            return redirect()->back()->withErrors([
                'unit' => "O limite de 15 inscrições para {$unidadeParaContagem} já foi atingido."
            ])->withInput();
        }

        $voluntario = InscricaoVoluntario::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shirt_size' => $request->shirt_size,
            'unit' => $request->unit,
            'support_unit' => $request->support_unit,
            'terms_accepted' => true
        ]);

        // Mail::to($voluntario->email)->send(new InscricaoVoluntarioMail($voluntario));

        return redirect()->back()->with('successVolun', 'Inscrição realizada com sucesso!');
    }
}
