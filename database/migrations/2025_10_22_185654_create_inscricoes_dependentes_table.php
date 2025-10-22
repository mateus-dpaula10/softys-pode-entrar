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
        Schema::create('inscricoes_dependentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscricao_colaborador_id')->constrained('inscricoes_colaboradores')->onDelete('cascade');
            $table->string('nome');
            $table->date('nascimento');
            $table->string('rg')->nullable();
            $table->string('parentesco');
            $table->string('email')->nullable();
            $table->text('autorizacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes_dependentes');
    }
};
