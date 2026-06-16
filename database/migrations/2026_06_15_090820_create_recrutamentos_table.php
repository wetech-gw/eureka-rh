<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recrutamentos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_vaga'); // Ex: "Desenvolvedor Full Stack", "Analista de Marketing", etc.
            $table->string('departamento'); // Ex: "TI", "Marketing", "Recursos Humanos", etc.
            $table->string('localizacao')->default('Bissau'); // Localização da vaga (ex: Bissau, Online, Remoto, etc.)
            $table->string('tipo_contrato'); // Ex: "Tempo Integral", "Estagio", "Contrato Temporário", etc.
            $table->integer('vagas_disponiveis')->default(1); // Número de vagas disponíveis para esta posição
            $table->text('descricao_vaga'); // Descrição detalhada da vaga, responsabilidades, requisitos, benefícios, etc.
            $table->text('requisitos'); // Requisitos necessários para a vaga (ex: "Experiência mínima de 2 anos", "Conhecimento em Laravel", etc.)
            $table->date('data_limite'); // Data limite para candidaturas
            $table->string('status')->default('Ativo'); // Ativo ou Encerrado
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recrutamentos');
    }
};