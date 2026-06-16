<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabela de Objetivos Estratégicos (OKRs)
        Schema::create('metas_estrategicas', function (Blueprint $class) {
            $class->id();
            $class->string('titulo'); // Ex: "Otimizar Experiência do Website Bissau-Digital"
            $class->string('departamento')->default('Geral');
            $class->integer('progresso_atual')->default(0); // 0 a 100%
            $class->date('prazo_limite');
            $class->enum('prioridade', ['Baixa', 'Média', 'Alta', 'Crítica'])->default('Média');
            $class->timestamps();
        });

        // 2. Tabela de Indicadores Operacionais Mensais (Métricas de RH)
        Schema::create('indicadores_operacionais', function (Blueprint $class) {
            $class->id();
            $class->string('mes_ano'); // Ex: "Junho 2026"
            $class->decimal('taxa_turnover', 5, 2)->default(0.00); // Rotação de pessoal
            $class->integer('indice_clima_enps')->default(0); // Score de satisfação (-100 a 100)
            $class->decimal('orcamento_gasto', 12, 2)->default(0.00); // Gastos com retiros/formações
            $class->decimal('orcamento_limite', 12, 2)->default(0.00);
            $class->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicadores_operacionais');
        Schema::dropIfExists('metas_estrategicas');
    }
};