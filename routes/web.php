<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscricaoController;

Route::get('/', function () {
    return view('lp.index');
});

Route::post('/inscricoes-colaboradores', [InscricaoController::class, 'store'])->name('inscricoes.colaboradores.store');
