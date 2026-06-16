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
        Schema::create('folhas_salariais', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com o funcionário
            $table->unsignedBigInteger('funcionario_id');
            
            // Período
            $table->integer('mes');
            $table->integer('ano');
            
            // Assiduidade
            $table->integer('faltas')->default(0);
            
            // Valores Financeiros (Usamos decimal para valores monetários precisos)
            $table->decimal('salario_bruto', 12, 2);
            $table->decimal('imposto_profissional', 12, 2)->default(0);
            $table->decimal('imposto_democracia', 12, 2)->default(0);
            $table->decimal('imposto_selo', 12, 2)->default(0);
            $table->decimal('inss', 12, 2)->default(0);
            $table->decimal('desconto_faltas', 12, 2)->default(0);
            $table->decimal('salario_liquido', 12, 2);
            
            // Controlo de Estado (Pendente ou Pago)
            $table->string('status')->default('Pendente');
            
            $table->timestamps();

            // Criar uma ligação (Chave Estrangeira) com a tabela de funcionários
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folhas_salariais');
    }
};