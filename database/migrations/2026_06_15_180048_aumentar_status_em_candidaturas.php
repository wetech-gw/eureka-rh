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
        // Altera a coluna para aceitar texto maior e remove restrições antigas
        $table->string('status', 50)->default('pendente')->change();
    });
}

public function down(): void
{
    Schema::table('candidaturas', function (Blueprint $table) {
        $table->string('status', 255)->change();
    });
}
};
