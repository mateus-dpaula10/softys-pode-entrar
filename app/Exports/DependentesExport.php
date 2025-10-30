<?php

namespace App\Exports;

use App\Models\InscricaoDependente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DependentesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InscricaoDependente::with('colaborador')->get()->map(function($item) {
            return [
                'colaborador' => $item->colaborador?->nome ?? 'N/A',
                'nome' => $item->nome,
                'nascimento' => $item->nascimento,
                'rg' => $item->rg,
                'parentesco' => $item->parentesco,
                'email' => $item->email,
                'autorizacao' => $item->autorizacao,
                'created_at' => $item->created_at
                    ? $item->created_at->format('d/m/Y H:i')
                    : null,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Colaborador',
            'Nome',
            'Nascimento',
            'RG',
            'Parentesco',
            'Email',
            'Autorização',
            'Data de Inscrição'
        ];
    }
}
