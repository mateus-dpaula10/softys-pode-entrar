<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscricoes_colaboradores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique()->nullable();
            $table->string('telefone')->nullable();
            $table->string('unidade');
            $table->string('diretoria');
            $table->string('unidade_escolha_comercial')->nullable();
            $table->string('unidade_escolha_comercial_vo')->nullable();
            $table->string('transporte_caieiras')->nullable();
            $table->string('transporte_pirai')->nullable();
            $table->string('rota_pirai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes_colaboradores');
    }
};
