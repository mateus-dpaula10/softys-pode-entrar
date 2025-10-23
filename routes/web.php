<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('lp.index');
});

Route::post('/inscricoes-colaboradores', [InscricaoController::class, 'storeColab'])->name('inscricoes.colaboradores.storeColab');
Route::post('/inscricoes-voluntarios', [InscricaoController::class, 'storeVolun'])->name('inscricoes.colaboradores.storeVolun');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logar'])->name('logar');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');