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
        Schema::create('formacoes', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->string('entidade');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('carga_horaria');
            $table->string('status')->default('Planeada'); // Planeada, Em Curso, Concluída
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacoes');
    }
};
