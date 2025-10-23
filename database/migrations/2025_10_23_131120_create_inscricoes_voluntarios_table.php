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
        Schema::create('inscricoes_voluntarios', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('shirt_size', ['P', 'M', 'G', 'GG']);
            $table->enum('unit', ['Anápolis', 'Caieiras', 'Mogi das Cruzes', 'Piraí', 'Vila Olímpia']);
            $table->enum('support_unit', ['Caieiras', 'Mogi das Cruzes'])->nullable();
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes_voluntarios');
    }
};
