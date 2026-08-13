<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('numero_referencia', 50)->nullable()->after('nome');
            $table->dropColumn(['versao', 'nivel_acesso']);
        });
    }

    public function down(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropColumn('numero_referencia');
            $table->string('versao', 20)->default('1.0');
            $table->string('nivel_acesso', 30)->default('Interno');
        });
    }
};
