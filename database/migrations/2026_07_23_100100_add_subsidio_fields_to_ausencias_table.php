<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ausencias', function (Blueprint $table) {
            $table->boolean('direito_subsidio_ferias')->default(false)->after('estado_pedido');
            $table->decimal('valor_subsidio_ferias', 12, 2)->default(0)->after('direito_subsidio_ferias');
            $table->string('estado_pagamento_subsidio', 30)->default('Não aplicável')->after('valor_subsidio_ferias');
        });
    }

    public function down(): void
    {
        Schema::table('ausencias', function (Blueprint $table) {
            $table->dropColumn([
                'direito_subsidio_ferias',
                'valor_subsidio_ferias',
                'estado_pagamento_subsidio',
            ]);
        });
    }
};
