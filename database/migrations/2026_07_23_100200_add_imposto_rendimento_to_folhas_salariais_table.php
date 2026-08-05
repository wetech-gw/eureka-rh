<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('folhas_salariais', function (Blueprint $table) {
            $table->decimal('imposto_rendimento', 12, 2)->default(0)->after('salario_bruto');
        });
    }

    public function down(): void
    {
        Schema::table('folhas_salariais', function (Blueprint $table) {
            $table->dropColumn('imposto_rendimento');
        });
    }
};
