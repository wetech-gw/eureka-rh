<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            // Ligação ao funcionário
            $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
            
            $table->date('data_avaliacao');                     // Data limite/agendada para a avaliação
            $table->string('estado')->default('Pendente');     // Pendente, Concluída, Cancelada
            $table->integer('nota')->nullable();                // Pontuação (ex: 1 a 5 ou 1 a 100)
            $table->text('comentarios')->nullable();            // Feedback dos RH / Gestor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};