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
        Schema::table('users', function (Blueprint $blueprint) {
            // Adiciona a coluna 'role' após o e-mail, definindo 'Assistente' como padrão por segurança
            $blueprint->string('role')->default('Assistente')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            // Remove a coluna caso seja feito um rollback
            $blueprint->dropColumn('role');
        });
    }
};