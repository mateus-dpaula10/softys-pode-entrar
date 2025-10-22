<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscricaoColaborador;

class InscricaoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:inscricoes_colaboradores,nome',
            'email' => 'nullable|email|max:255',
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
            'nome.unique' => 'Nome já cadastrado na base de dados.',
            'nome.required' => 'O campo Nome do colaborador é obrigatório.',
            'email.email' => 'O e-mail do colaborador deve ser válido.',
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

        $totalUnidade = InscricaoColaborador::where('unidade', $request->unidade)->count();
        if ($totalUnidade >= 120) {
            return redirect()->back()->withErrors([
                'unidade' => 'O limite de 120 inscrições para a unidade selecionada já foi atingido.'
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
}
