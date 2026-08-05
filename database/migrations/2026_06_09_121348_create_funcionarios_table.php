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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            
            // 1. Informações Pessoais e Contacto
            $table->string('nome');
            $table->string('email')->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('contacto', 20)->nullable();
            $table->string('empresa')->default('Eureka Consulting'); 
            
            // 2. Documentos de Identificação e Fiscais
            $table->string('bi', 30)->nullable(); 
            $table->string('nif', 30)->nullable()->unique(); 
            
            // 3. Informações de Contrato e Carreira
            $table->string('cargo'); 
            $table->string('iniciais', 3);
            $table->enum('estado', ['Activo', 'Inactivo', 'Suspenso'])->default('Activo');
            $table->string('tipo_contrato')->default('Permanente'); 
            
            // Datas de Controlo de Contrato
            $table->date('data_inicio_contrato');
            $table->date('data_fim_periodo_experiencia')->nullable(); // Fin de periode essaie
            $table->date('data_fim_contrato')->nullable();
            
            // 4. Segurança Social (INSS)
            $table->date('data_inscricao_inss')->nullable();
            $table->string('num_seguranca_social', 50)->nullable();
            
            // 5. Dados Bancários
            $table->string('num_conta_bancaria', 50)->nullable();
            $table->string('banco', 100)->nullable();
            
            // 6. Dados Financeiros e de Categoria Fiscal
            $table->enum('tipo_trabalhador', ['Subordinado', 'Liberal'])->default('Subordinado');
            $table->decimal('salario_bruto', 12, 2)->default(0.00); // Apenas o Salário Bruto puro
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};