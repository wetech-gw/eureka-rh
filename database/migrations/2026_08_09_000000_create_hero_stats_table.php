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
        // Tabela: Estatísticas do Hero (10+ anos, 200+ clientes, 14+ serviços)
        Schema::create('hero_stats', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('suffix')->nullable();
            $table->string('label');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_stats');
    }
};
