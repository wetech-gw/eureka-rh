<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PresencaController extends Controller
{
    /**
     * Exibe a listagem de presenças e métricas.
     */
    public function index()
    {
        // 1. Definição de Datas para as Métricas
        $hoje = Carbon::today()->toDateString();
        $inicioMes = Carbon::now()->startOfMonth()->toDateString();
        $fimMes = Carbon::now()->endOfMonth()->toDateString();

        // Métricas 1: Presenças Hoje (Presentes ou Atrasados)
        $presencasHoje = DB::table("presencas")
            ->whereDate("data", $hoje)
            ->whereIn("status_hoje", ["Presente", "Atrasado"])
            ->count();

        // Métricas 2: Faltas Este Mês
        $faltasEsteMes = DB::table("presencas")
            ->whereBetween("data", [$inicioMes, $fimMes])
            ->where("status_hoje", "LIKE", "%Falta%")
            ->count();

        // Métricas 3: Cálculo da Taxa de Assiduidade deste mês
        $totalRegistosMes = DB::table("presencas")
            ->whereBetween("data", [$inicioMes, $fimMes])
            ->count();

        $totalPresentesMes = DB::table("presencas")
            ->whereBetween("data", [$inicioMes, $fimMes])
            ->whereIn("status_hoje", ["Presente", "Atrasado"])
            ->count();

        $taxaAssiduidade =
            $totalRegistosMes > 0
                ? round(($totalPresentesMes / $totalRegistosMes) * 100, 1)
                : 100; // Caso não haja registos, assume 100%

        // 2. Lista de Funcionários para o Modal de Novo Registo
        $funcionarios = DB::table("funcionarios")
            ->select("id", "nome", "cargo")
            ->orderBy("nome", "asc")
            ->get();

        // 3. Consulta Principal (Listagem Paginada)
        $presencas = DB::table("presencas")
            ->join(
                "funcionarios",
                "presencas.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->select(
                "presencas.*",
                "presencas.entrada as hora_entrada", // Converte entrada -> hora_entrada
                "presencas.saida as hora_saida", // Converte saida -> hora_saida
                "presencas.status_hoje as estado", // Converte status_hoje -> estado
                "funcionarios.nome",
                "funcionarios.cargo",
                //'funcionarios.iniciais'
            )
            ->orderBy("presencas.data", "desc")
            ->orderBy("presencas.entrada", "desc")
            ->paginate(15);

        // 4. Retorno para a View com todos os dados necessários
        return view(
            "presencas",
            compact(
                "presencas",
                "presencasHoje",
                "faltasEsteMes",
                "taxaAssiduidade",
                "funcionarios",
            ),
        );
    }

    /**
     * Grava um novo registo de presença na base de dados.
     */
    /**
     * Grava um novo registo de presença na base de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados enviados pelo formulário do Modal
        $request->validate([
            "funcionario_id" => "required",
            "data" => "required|date",
            "hora_entrada" => "nullable",
            "hora_saida" => "nullable",
            "estado" => "required|string",
            "observacoes" => "nullable|string",
        ]);

        // 2. Define o valor baseado no estado capturado do formulário
        $statusBanco = $request->estado === "Falta" ? "Falta" : "Presente";

        // 3. Gravar na tabela "presencas"
        DB::table("presencas")->insert([
            "funcionario_id" => $request->funcionario_id,
            "data" => $request->data,
            "entrada" => $request->hora_entrada,
            "saida" => $request->hora_saida,
            "status_hoje" => $statusBanco,
            "observacoes" => $request->observacoes,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // 4. Redirecionar com mensagem de sucesso
        return redirect()
            ->route("presencas.index")
            ->with("success", "Presença registada com sucesso!");
    }

    /**
     * Atualiza um registo de presença existente.
     */
    public function update(Request $request, $id)
    {
        // 1. Validação dos dados do formulário de edição
        $request->validate([
            "data" => "required|date",
            "hora_entrada" => "nullable",
            "hora_saida" => "nullable",
            "estado" => "required",
            "observacoes" => "nullable",
        ]);

        // 2. Atualizar o registo específico usando o ID passado na rota
        DB::table("presencas")
            ->where("id", $id)
            ->update([
                "data" => $request->data,
                "entrada" => $request->hora_entrada,
                "saida" => $request->hora_saida,
                "status_hoje" => $request->estado,
                "observacoes" => $request->observacoes,
                "updated_at" => now(),
            ]);

        // 3. Redirecionar de volta para a tabela atualizada
        return redirect()
            ->route("presencas.index")
            ->with("success", "Registo de presença atualizado com sucesso!");
    }
}
