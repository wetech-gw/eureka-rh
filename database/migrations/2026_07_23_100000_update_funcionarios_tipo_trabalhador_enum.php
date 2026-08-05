<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE funcionarios MODIFY tipo_trabalhador ENUM('Subordinado','Supervisor','Liberal') NOT NULL DEFAULT 'Subordinado'");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE funcionarios MODIFY tipo_trabalhador ENUM('Subordinado','Liberal') NOT NULL DEFAULT 'Subordinado'");
        }
    }
};
