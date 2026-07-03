<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("documentos", function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->enum("tipo", ["Entrada", "Saída"]);
            $table->date("data_operacao");
            $table->string("departamento");
            $table->string("arquivo_pdf")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("documentos");
    }
};
