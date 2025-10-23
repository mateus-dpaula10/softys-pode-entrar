<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscricaoController;

Route::get('/', function () {
    return view('lp.index');
});

Route::post('/inscricoes-colaboradores', [InscricaoController::class, 'storeColab'])->name('inscricoes.colaboradores.storeColab');
Route::post('/inscricoes-voluntarios', [InscricaoController::class, 'storeVolun'])->name('inscricoes.colaboradores.storeVolun');