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
        // Tabela: Informações de Contacto (Endereço, Telefones, Email, Horário)
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('phones')->nullable();
            $table->string('email')->nullable();
            $table->string('schedule')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
