<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, clean up any invalid data (convert 'Atrasado' to 'Atraso', etc.)
        DB::table('presencas')->where('status_hoje', 'Atrasado')->update(['status_hoje' => 'Atraso']);
        
        // Then alter the enum
        DB::statement("ALTER TABLE presencas MODIFY COLUMN status_hoje ENUM('Presente', 'Atraso', 'Ausente', 'Falta Justificada', 'Falta Injustificada') DEFAULT 'Presente'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE presencas MODIFY COLUMN status_hoje ENUM('Presente', 'Atraso', 'Ausente') DEFAULT 'Presente'");
    }
};
