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
    Schema::create('presencas', function (Blueprint $table) {
        $table->id();
        
        // ATENÇÃO AQUI: Tem de ser exatamente 'funcionario_id'
        $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
        
        $table->date('data');
        $table->time('entrada')->nullable();
        $table->time('saida')->nullable();
        $table->integer('horas_trabalhadas_dia')->default(0);
        $table->enum('status_hoje', ['Presente', 'Atrasado', 'Ausente'])->default('Presente');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
