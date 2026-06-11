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
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaga_id')->constrained('vagas')->onDelete('cascade');
            $table->foreignId('candidato_id')->constrained('candidatos')->onDelete('cascade');
            
            // Onde o ficheiro PDF do CV vai ficar guardado no servidor
            $table->string('cv_arquivo')->nullable(); 
            
            // O Estado da candidatura desta pessoa a esta vaga específica
            $table->enum('status', [
                'Novo', 
                'Em Avaliação', 
                'Entrevista', 
                'Aprovado', 
                'Rejeitado'
            ])->default('Novo');
            
            $table->timestamps();
            
            // Garante que o mesmo candidato não se candidata 2 vezes à mesma vaga
            $table->unique(['vaga_id', 'candidato_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
    }
};
