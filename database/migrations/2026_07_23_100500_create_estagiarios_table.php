<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estagiarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('telefone', 30)->nullable();
            $table->string('instituicao_ensino');
            $table->string('curso');
            $table->string('supervisor_responsavel');
            $table->string('departamento');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->text('plano_atividades')->nullable();
            $table->text('avaliacao_desempenho')->nullable();
            $table->string('arquivo_certificado')->nullable();
            $table->string('status', 30)->default('Ativo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estagiarios');
    }
};
