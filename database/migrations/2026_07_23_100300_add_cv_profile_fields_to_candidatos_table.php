<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->string('profissao')->nullable()->after('telefone');
            $table->string('nivel_academico')->nullable()->after('profissao');
            $table->unsignedInteger('anos_experiencia')->nullable()->after('nivel_academico');
            $table->text('competencias')->nullable()->after('anos_experiencia');
            $table->string('localizacao')->nullable()->after('competencias');
        });
    }

    public function down(): void
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropColumn([
                'profissao',
                'nivel_academico',
                'anos_experiencia',
                'competencias',
                'localizacao',
            ]);
        });
    }
};
