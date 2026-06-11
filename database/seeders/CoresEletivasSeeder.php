<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Adicione esta linha no topo
use Carbon\Carbon;

class CoresEletivasSeeder extends Seeder
{
    public function run(): void
    {
        // Desativar chaves estrangeiras temporariamente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // SÓ limpa as tabelas se elas realmente já existirem no banco
        if (Schema::hasTable('ausencias')) { DB::table('ausencias')->truncate(); }
        if (Schema::hasTable('presencas')) { DB::table('presencas')->truncate(); }
        if (Schema::hasTable('funcionarios')) { DB::table('funcionarios')->truncate(); }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ... O resto do código com os inserts da Sidia e do Amadu continua IGUALzinho abaixo ...

        // 2. Inserir a Sidia Malam Inquade (ID: 1)
        DB::table('funcionarios')->insert([
            'id' => 1,
            'nome' => 'Sidia Malam Inquade',
            'cargo' => 'Dev Frontend',
            'iniciais' => 'SMI',
            'estado' => 'Activo',
            'tipo_contrato' => 'Permanente',
            'data_fim_contrato' => null,
            'salario_base' => 350000.00,
            'horas_esperadas_mes' => 160,
            'valor_hora_extra' => 3200.00,
            'valor_desconto_falta' => 2100.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Inserir o Elson Sakhir Ba (ID: 2)
        DB::table('funcionarios')->insert([
            'id' => 2,
            'nome' => 'Elson Sakhir Ba',
            'cargo' => 'Dev Backend',
            'iniciais' => 'ESB',
            'estado' => 'Activo',
            'tipo_contrato' => 'Prazo fixo',
            // Define o fim do contrato para daqui a 8 dias exatos (igual ao alerta do seu printscreen)
            'data_fim_contrato' => Carbon::now()->addDays(8)->toDateString(),
            'salario_base' => 280000.00,
            'horas_esperadas_mes' => 160,
            'valor_hora_extra' => 2600.00,
            'valor_desconto_falta' => 1750.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Inserir a Presença de Hoje (Para alimentar o bloco "Presença — Hoje")
        DB::table('presencas')->insert([
            'funcionario_id' => 1, // Sidia
            'data' => Carbon::today()->toDateString(),
            'entrada' => '08:00:00',
            'saida' => null,
            'horas_trabalhadas_dia' => 4, // Meio período até agora
            'status_hoje' => 'Presente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. Inserir as Ausências de Maio (Para pintar o mini-calendário igual ao print)
        // Dias 7 e 8 a amarelo (Falta Justificada / Atenção)
        DB::table('ausencias')->insert([
            [
                'funcionario_id' => 2, // Amadu
                'data_ausencia' => '2026-05-07',
                'tipo' => 'Falta Justificada',
                'observacao' => 'Consulta médica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'funcionario_id' => 2,
                'data_ausencia' => '2026-05-08',
                'tipo' => 'Falta Justificada',
                'observacao' => 'Acompanhamento familiar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dia 13 a verde/azul (Férias)
            [
                'funcionario_id' => 1, // Sidia
                'data_ausencia' => '2026-05-13',
                'tipo' => 'Férias',
                'observacao' => 'Gozo de férias aprovado',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}