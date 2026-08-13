<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AtualizarEstados extends Command
{
    protected $signature = 'estados:atualizar';

    protected $description = 'Expira vagas cuja data_limite já passou e finaliza formações cuja data_fim já passou';

    public function handle(): int
    {
        $hoje = Carbon::today();

        $vagasExpiradas = DB::table('recrutamentos')
            ->where('status', 'Ativo')
            ->where('data_limite', '<', $hoje->toDateString())
            ->update([
                'status' => 'Expirado',
                'updated_at' => now(),
            ]);

        $formacoesFinalizadas = DB::table('formacoes')
            ->where('status', '!=', 'Concluída')
            ->whereNotNull('data_fim')
            ->where('data_fim', '<', $hoje->toDateString())
            ->update([
                'status' => 'Concluída',
                'updated_at' => now(),
            ]);

        $this->info("Vagas expiradas: {$vagasExpiradas}");
        $this->info("Formações concluídas: {$formacoesFinalizadas}");

        return self::SUCCESS;
    }
}
