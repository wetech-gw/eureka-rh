<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstrategiaController extends Controller
{
    public function index()
    {
        $metas = DB::table("metas_estrategicas")
            ->orderBy("created_at", "desc")
            ->get();

        $indicadores = DB::table("indicadores_operacionais")->latest()->first();

        return view("operacional_estrategia", compact("metas", "indicadores"));
    }

    // Atualizar o progresso de uma meta estratégica por clique direto (+10%)
    public function progresso(Request $request, $id)
    {
        $meta = DB::table("metas_estrategicas")->where("id", $id)->first();
        $novoProgresso = min($meta->progresso_atual + 10, 100);

        DB::table("metas_estrategicas")
            ->where("id", $id)
            ->update([
                "progresso_atual" => $novoProgresso,
                "updated_at" => now(),
            ]);

        return redirect()
            ->back()
            ->with("success", "Progresso da meta estratégica atualizado!");
    }

    /**
     * Salvar um novo planeamento/meta estratégica (Modal Criar)
     */
    public function store(Request $request)
    {
        $request->validate([
            "titulo" => "required|string|max:255",
            "departamento" => "required|string|max:255",
            "prioridade" => "required|string",
            "prazo_limite" => "required|date",
            "progresso_atual" => "required|integer|min:0|max:100",
        ]);

        DB::table("metas_estrategicas")->insert([
            "titulo" => $request->titulo,
            "departamento" => $request->departamento,
            "prioridade" => $request->prioridade,
            "prazo_limite" => $request->prazo_limite,
            "progresso_atual" => $request->progresso_atual,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        return redirect()
            ->back()
            ->with("success", "Novo objetivo planeado com sucesso!");
    }

    /**
     * Atualizar os detalhes de uma meta existente (Modal Editar)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "titulo" => "required|string|max:255",
            "departamento" => "required|string|max:255",
            "prioridade" => "required|string",
            "prazo_limite" => "required|date",
            "progresso_atual" => "required|integer|min:0|max:100",
        ]);

        DB::table("metas_estrategicas")
            ->where("id", $id)
            ->update([
                "titulo" => $request->titulo,
                "departamento" => $request->departamento,
                "prioridade" => $request->prioridade,
                "prazo_limite" => $request->prazo_limite,
                "progresso_atual" => $request->progresso_atual,
                "updated_at" => now(),
            ]);

        return redirect()
            ->back()
            ->with(
                "success",
                "Planeamento estratégico atualizado com sucesso!",
            );
    }

    public function updateIndicadores(Request $request)
    {
        $request->validate([
            "taxa_turnover" => "required|numeric|min:0|max:100",
            "indice_clima_enps" => "required|integer|min:-100|max:100",
            "orcamento_gasto" => "nullable|numeric|min:0", // Alterado para nullable
            "orcamento_limite" => "nullable|numeric|min:0", // Alterado para nullable
        ]);

        // Define automaticamente o mês/ano corrente (Ex: 2026-07)
        $mesAnoAtual = now()->format("Y-m");

        // Se houver um registo, atualiza-o. Se não houver, cria o primeiro.
        $existe = DB::table("indicadores_operacionais")->first();

        if ($existe) {
            DB::table("indicadores_operacionais")
                ->where("id", $existe->id)
                ->update([
                    "taxa_turnover" => $request->taxa_turnover,
                    "indice_clima_enps" => $request->indice_clima_enps,
                    // Se vier vazio (null), grava 0 para não quebrar a restrição do banco
                    "orcamento_gasto" => $request->orcamento_gasto ?? 0,
                    "orcamento_limite" => $request->orcamento_limite ?? 0,
                    "mes_ano" => $mesAnoAtual,
                    "updated_at" => now(),
                ]);
        } else {
            DB::table("indicadores_operacionais")->insert([
                "taxa_turnover" => $request->taxa_turnover,
                "indice_clima_enps" => $request->indice_clima_enps,
                // Se vier vazio (null), grava 0 para não quebrar a restrição do banco
                "orcamento_gasto" => $request->orcamento_gasto ?? 0,
                "orcamento_limite" => $request->orcamento_limite ?? 0,
                "mes_ano" => $mesAnoAtual,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }

        return redirect()
            ->back()
            ->with(
                "success",
                "Indicadores de Saúde Organizacional atualizados!",
            );
    }
}
