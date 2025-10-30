<?php

namespace App\Exports;

use App\Models\InscricaoVoluntario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoluntariosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InscricaoVoluntario::all()->map(function($item) {
            return [
                'full_name' => $item->full_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'shirt_size' => $item->shirt_size,
                'unit_original' => $item->unit,
                'unit_contabilizada' => $item->support_unit ?: $item->unit,
                'support_unit' => $item->support_unit,
                'terms_accepted' => $item->terms_accepted,
                'created_at' => $item->created_at
                    ? $item->created_at->format('d/m/Y H:i')
                    : null,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nome Completo',
            'Email',
            'Telefone',
            'Tamanho da Camisa',
            'Unidade Original',
            'Unidade Contabilizada',
            'Unidade de Apoio',
            'Termos Aceitos',
            'Data de Inscrição'
        ];
    }
}
