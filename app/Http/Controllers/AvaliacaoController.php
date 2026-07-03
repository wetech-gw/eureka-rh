<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $hoje = Carbon::today()->toDateString();

        // 1. Estatísticas para os Cards superiores
        $totalPendentes = DB::table("avaliacoes")
            ->where("estado", "Pendente")
            ->count();

        $concluidasEsteMes = DB::table("avaliacoes")
            ->where("estado", "Concluída")
            ->whereMonth("updated_at", Carbon::now()->month)
            ->whereYear("updated_at", Carbon::now()->year)
            ->count();

        // Calcula a média das notas (de 1 a 5, por exemplo) apenas das concluídas
        $mediaGlobal = DB::table("avaliacoes")
            ->where("estado", "Concluída")
            ->avg("nota");

        $mediaGlobal = $mediaGlobal ? number_format($mediaGlobal, 1) : "0.0";

        // 2. Lista de funcionários ativos para o select do modal de agendamento
        $funcionarios = DB::table("funcionarios")
            ->where("estado", "Activo")
            ->orderBy("nome", "asc")
            ->get();

        // 3. Listagem principal unindo com os dados do Funcionário
        $avaliacoes = DB::table("avaliacoes")
            ->join(
                "funcionarios",
                "avaliacoes.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->select("avaliacoes.*", "funcionarios.nome", "funcionarios.cargo")
            ->orderBy("avaliacoes.data_avaliacao", "asc")
            ->get();

        return view(
            "avaliacoes",
            compact(
                "totalPendentes",
                "concluidasEsteMes",
                "mediaGlobal",
                "funcionarios",
                "avaliacoes",
            ),
        );
    }

    public function store(Request $request)
    {
        DB::table("avaliacoes")->insert([
            "funcionario_id" => $request->funcionario_id,
            "data_avaliacao" => $request->data_avaliacao,
            "estado" => "Pendente",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        return redirect()
            ->back()
            ->with("success", "Avaliação agendada com sucesso!");
    }

    public function update(Request $request, $id)
    {
        // Se o utilizador submeteu uma nota, consideramos o estado como "Concluída"
        $estado = $request->nota ? "Concluída" : $request->estado;

        DB::table("avaliacoes")
            ->where("id", $id)
            ->update([
                "data_avaliacao" => $request->data_avaliacao,
                "nota" => $request->nota,
                "estado" => $estado,
                "comentarios" => $request->comentarios,
                "updated_at" => Carbon::now(),
            ]);

        return redirect()
            ->back()
            ->with("success", "Avaliação atualizada com sucesso!");
    }
}
