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
        // Tabela: BOOST_ME — Acelerador de Empresas (secção do site público)
        Schema::create('boost_mes', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('description');
            $table->text('features')->nullable(); // Uma feature por linha
            $table->string('cta1')->nullable();
            $table->string('cta2')->nullable();
            $table->string('cta3')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boost_mes');
    }
};
