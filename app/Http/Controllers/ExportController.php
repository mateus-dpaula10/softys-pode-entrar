<?php

namespace App\Http\Controllers;

use App\Exports\ColaboradoresExport;
use App\Exports\VoluntariosExport;
use App\Exports\DependentesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportColaboradores()
    {
        return Excel::download(new ColaboradoresExport, 'colaboradores.xlsx');
    }

    public function exportVoluntarios()
    {
        return Excel::download(new VoluntariosExport, 'voluntarios.xlsx');
    }

    public function exportDependentes()
    {
        return Excel::download(new DependentesExport, 'dependentes.xlsx');
    }
}
