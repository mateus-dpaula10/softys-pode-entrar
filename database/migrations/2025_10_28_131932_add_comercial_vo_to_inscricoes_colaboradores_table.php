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
        Schema::table('inscricoes_colaboradores', function (Blueprint $table) {
            $table->string('unidade_escolha_comercial_vo')->nullable()->after('unidade_escolha_comercial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscricoes_colaboradores', function (Blueprint $table) {
            $table->dropColumn('unidade_escolha_comercial_vo');
        });
    }
};
