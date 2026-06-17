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

    // ... código anterior do seu controlador ...

    /**
     * Salvar um novo planeamento/meta estratégica (Modal Criar)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'prioridade' => 'required|string',
            'prazo_limite' => 'required|date',
            'progresso_atual' => 'required|integer|min:0|max:100',
        ]);

        DB::table('metas_estrategicas')->insert([
            'titulo' => $request->titulo,
            'departamento' => $request->departamento,
            'prioridade' => $request->prioridade,
            'prazo_limite' => $request->prazo_limite,
            'progresso_atual' => $request->progresso_atual,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Novo objetivo planeado com sucesso!');
    }

    /**
     * Atualizar os detalhes de uma meta existente (Modal Editar)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'prioridade' => 'required|string',
            'prazo_limite' => 'required|date',
            'progresso_atual' => 'required|integer|min:0|max:100',
        ]);

        DB::table('metas_estrategicas')->where('id', $id)->update([
            'titulo' => $request->titulo,
            'departamento' => $request->departamento,
            'prioridade' => $request->prioridade,
            'prazo_limite' => $request->prazo_limite,
            'progresso_atual' => $request->progresso_atual,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Planeamento estratégico atualizado com sucesso!');
    }

        public function updateIndicadores(Request $request)
    {
        $request->validate([
            'taxa_turnover' => 'required|numeric|min:0|max:100',
            'indice_clima_enps' => 'required|integer|min:-100|max:100',
            'orcamento_gasto' => 'required|numeric|min:0',
            'orcamento_limite' => 'required|numeric|min:0',
        ]);

        // Opção Inteligente: Se já houver um registo, atualiza-o. Se não houver, cria o primeiro.
        $existe = DB::table('indicadores_operacionais')->first();

        if ($existe) {
            DB::table('indicadores_operacionais')->where('id', $existe->id)->update([
                'taxa_turnover' => $request->taxa_turnover,
                'indice_clima_enps' => $request->indice_clima_enps,
                'orcamento_gasto' => $request->orcamento_gasto,
                'orcamento_limite' => $request->orcamento_limite,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('indicadores_operacionais')->insert([
                'taxa_turnover' => $request->taxa_turnover,
                'indice_clima_enps' => $request->indice_clima_enps,
                'orcamento_gasto' => $request->orcamento_gasto,
                'orcamento_limite' => $request->orcamento_limite,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Indicadores de Saúde Organizacional atualizados!');
    }
}