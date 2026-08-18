<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidaturas_espontaneas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('email', 150);
            $table->string('telefone', 50)->nullable();
            $table->string('profissao')->nullable();
            $table->string('nivel_academico', 120)->nullable();
            $table->unsignedInteger('anos_experiencia')->nullable();
            $table->text('competencias')->nullable();
            $table->string('localizacao')->nullable();
            $table->string('cv_arquivo')->nullable();
            $table->string('carta_motivacao_arquivo')->nullable();
            $table->string('status', 50)->default('Pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidaturas_espontaneas');
    }
};
