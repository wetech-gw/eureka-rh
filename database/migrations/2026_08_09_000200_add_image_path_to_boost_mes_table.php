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
        // Adiciona suporte a imagem na secção BOOST_ME
        Schema::table('boost_mes', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boost_mes', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
