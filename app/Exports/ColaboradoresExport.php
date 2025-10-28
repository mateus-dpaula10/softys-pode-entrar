<?php

namespace App\Exports;

use App\Models\InscricaoColaborador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ColaboradoresExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InscricaoColaborador::all()->map(function($item) {
            $unidadeContabilizada = $item->unidade_escolha_comercial_vo
                ?: $item->unidade_escolha_comercial
                ?: $item->unidade;

            return [
                'nome' => $item->nome,
                'email' => $item->email,
                'telefone' => $item->telefone,
                'unidade_original' => $item->unidade,
                'diretoria' => $item->diretoria,
                'unidade_contabilizada' => $unidadeContabilizada,
                'unidade_escolha_comercial' => $item->unidade_escolha_comercial,
                'unidade_escolha_comercial_vo' => $item->unidade_escolha_comercial_vo,
                'transporte_caieiras' => $item->transporte_caieiras,
                'transporte_pirai' => $item->transporte_pirai,
                'rota_pirai' => $item->rota_pirai,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Telefone',
            'Unidade Original',
            'Diretoria',
            'Unidade Contabilizada',
            'Unidade Escolha VO',
            'Unidade Escolha Comercial e VO',
            'Transporte Caieiras',
            'Transporte Piraí',
            'Rota Piraí'
        ];
    }
}
