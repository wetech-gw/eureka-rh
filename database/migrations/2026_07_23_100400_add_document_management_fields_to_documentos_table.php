<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->string('categoria')->default('Geral')->after('nome');
            $table->string('versao', 20)->default('1.0')->after('categoria');
            $table->string('nivel_acesso', 30)->default('Interno')->after('versao');
        });
    }

    public function down(): void
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropColumn(['categoria', 'versao', 'nivel_acesso']);
        });
    }
};
