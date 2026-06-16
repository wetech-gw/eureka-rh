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
    Schema::table('candidaturas', function (Blueprint $table) {
        // Remove a chave estrangeira antiga que aponta para 'vagas'
        $table->dropForeign(['vaga_id']);
        
        // Cria a nova restrição a apontar para 'recrutamentos'
        $table->foreign('vaga_id')->references('id')->on('recrutamentos')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('candidaturas', function (Blueprint $table) {
        $table->dropForeign(['vaga_id']);
        $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
    });
}
};
