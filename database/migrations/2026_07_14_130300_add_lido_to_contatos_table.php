<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("contatos", function (Blueprint $table) {
            $table->boolean("lido")->default(false)->after("mensagem");
        });
    }

    public function down(): void
    {
        Schema::table("contatos", function (Blueprint $table) {
            $table->dropColumn("lido");
        });
    }
};
