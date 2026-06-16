<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstrategiaController extends Controller
{
    public function index()
    {
        // Se a base de dados estiver vazia, inserimos alguns dados demonstrativos reais para a Eureka
        if (DB::table('metas_estrategicas')->count() == 0) {
            DB::table('metas_estrategicas')->insert([
                [
                    'titulo' => 'Implementação de Modelos de UX no Bissau-Digital',
                    'departamento' => 'Tecnologia & Produto',
                    'progresso_atual' => 75,
                    'prazo_limite' => '2026-07-31',
                    'prioridade' => 'Alta',
                    'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'titulo' => 'Programa de Retiros e Liderança Eureka Consulting',
                    'departamento' => 'Recursos Humanos',
                    'progresso_atual' => 100,
                    'prazo_limite' => '2026-05-31',
                    'prioridade' => 'Média',
                    'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'titulo' => 'Expansão da Infraestrutura de Agentes de Data Center',
                    'departamento' => 'Operações',
                    'progresso_atual' => 20,
                    'prazo_limite' => '2026-12-15',
                    'prioridade' => 'Crítica',
                    'created_at' => now(), 'updated_at' => now()
                ]
            ]);

            DB::table('indicadores_operacionais')->insert([
                'mes_ano' => 'Junho 2026',
                'taxa_turnover' => 2.4,
                'indice_clima_enps' => 68,
                'orcamento_gasto' => 425000.00, // Ex: em Francos CFA ou Euros consoante o vosso padrão
                'orcamento_limite' => 600000.00,
                'created_at' => now(), 'updated_at' => now()
            ]);
        }

        $metas = DB::table('metas_estrategicas')->get();
        $indicadores = DB::table('indicadores_operacionais')->orderBy('id', 'desc')->first();

        return view('operacional_estrategia', compact('metas', 'indicadores'));
    }

    // Atualizar o progresso de uma meta estratégica por clique direto (+10%)
    public function progresso(Request $request, $id)
    {
        $meta = DB::table('metas_estrategicas')->where('id', $id)->first();
        $novoProgresso = min($meta->progresso_atual + 10, 100);

        DB::table('metas_estrategicas')->where('id', $id)->update([
            'progresso_atual' => $novoProgresso,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Progresso da meta estratégica atualizado!');
    }
}