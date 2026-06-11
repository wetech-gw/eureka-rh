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
                $table->string('nome'); // <- VERIFIQUE SE ESTÁ EXATAMENTE ASSIM E NÃO 'name'
                $table->string('cargo');
                $table->string('iniciais', 3);
                $table->enum('estado', ['Activo', 'Inactivo', 'Suspenso'])->default('Activo');
                $table->string('tipo_contrato')->default('Permanente');
                $table->date('data_fim_contrato')->nullable();
                
                // Dados Financeiros
                $table->decimal('salario_base', 12, 2)->default(0.00);
                $table->integer('horas_esperadas_mes')->default(160);
                $table->decimal('valor_hora_extra', 10, 2)->default(0.00);
                $table->decimal('valor_desconto_falta', 10, 2)->default(0.00);
                
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
