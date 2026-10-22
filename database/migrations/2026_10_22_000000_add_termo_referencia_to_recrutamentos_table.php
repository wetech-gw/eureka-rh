<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recrutamentos', function (Blueprint $table) {
            $table->string('termo_referencia')->nullable()->after('requisitos');
        });
    }

    public function down(): void
    {
        Schema::table('recrutamentos', function (Blueprint $table) {
            $table->dropColumn('termo_referencia');
        });
    }
};
