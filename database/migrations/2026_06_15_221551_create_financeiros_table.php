<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financeiros', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->enum('tipo', ['Entrada', 'Saída']);
            $table->decimal('valor', 15, 2); // Suporta valores altos para FCFA
            $table->date('data_operacao');
            $table->string('categoria'); // Ex: Recursos Humanos, TI, Serviços
            $table->string('metodo_pagamento')->nullable(); // Ex: Transferência, Dinheiro
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financeiros');
    }
};