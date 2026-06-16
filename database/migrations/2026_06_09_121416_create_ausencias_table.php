<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ausencias', function (Blueprint $table) {
            $table->id();
            // Ligação ao funcionário (garante que o tipo de dados bate certo com o id dos funcionarios)
            $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
            
            $table->string('tipo'); // Férias, Falta, Licença
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('dias');
            $table->string('justificado')->default('Não'); // Sim, Não
            $table->string('estado_pedido')->default('Pendente'); // Aprovado, Pendente, Rejeitado
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ausencias');
    }
};