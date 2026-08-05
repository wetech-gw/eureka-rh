<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ausencias', function (Blueprint $table) {
            $table->decimal('valor_total_subsidio', 12, 2)->default(0)->after('valor_subsidio_ferias');
            $table->decimal('saldo_subsidio', 12, 2)->default(0)->after('valor_total_subsidio');
        });
    }

    public function down(): void
    {
        Schema::table('ausencias', function (Blueprint $table) {
            $table->dropColumn(['valor_total_subsidio', 'saldo_subsidio']);
        });
    }
};
