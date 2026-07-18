<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("contatos", function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("email");
            $table->text("mensagem");
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at' exigidas pelo orderBy
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("contatos");
    }
};
