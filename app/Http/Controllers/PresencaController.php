<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\LogsActivity;

class PresencaController extends Controller
{
    use LogsActivity;
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
            "data" => "required|date|after_or_equal:today|before_or_equal:today",
            "hora_entrada" => "nullable",
            "hora_saida" => "nullable",
            "estado" => "required|string",
            "observacoes" => "nullable|string",
        ], [
            "data.after_or_equal" =>
                "Não é possível registar presenças ou faltas em dias passados.",
            "data.before_or_equal" =>
                "Não é possível registar presenças ou faltas em dias futuros. Selecione a data de hoje.",
        ]);

        // 2. Normaliza o estado para um valor aceite pela base de dados
        $estadosValidos = [
            "Presente",
            "Atraso",
            "Ausente",
            "Falta Justificada",
            "Falta Injustificada",
        ];
        $statusBanco = $request->estado === "Falta"
            ? "Falta Injustificada"
            : $request->estado;
        if (!in_array($statusBanco, $estadosValidos, true)) {
            $statusBanco = "Presente";
        }

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

        $func = DB::table('funcionarios')->where('id', $request->funcionario_id)->first();
        $this->logActivity('create', 'Presença', null, 'Registou presença de ' . ($func->nome ?? 'desconhecido') . ' em ' . $request->data);

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

        $registo = DB::table("presencas")->where("id", $id)->first();
        $hoje = Carbon::today();
        $dataNova = Carbon::parse($request->data)->startOfDay();
        $dataOriginal = $registo
            ? Carbon::parse($registo->data)->startOfDay()
            : null;

        if (!$dataNova->equalTo($dataOriginal) && !$dataNova->equalTo($hoje)) {
            $mensagem = $dataNova->isBefore($hoje)
                ? "Não é possível alterar um registo para um dia passado."
                : "Não é possível alterar um registo para um dia futuro. Selecione a data de hoje.";

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["data" => $mensagem]);
        }

        // 2. Normaliza o estado para um valor aceite pela base de dados
        $estado = $request->estado === "Falta"
            ? "Falta Injustificada"
            : $request->estado;

        // 3. Atualizar o registo específico usando o ID passado na rota
        DB::table("presencas")
            ->where("id", $id)
            ->update([
                "data" => $request->data,
                "entrada" => $request->hora_entrada,
                "saida" => $request->hora_saida,
                "status_hoje" => $estado,
                "observacoes" => $request->observacoes,
                "updated_at" => now(),
            ]);

        $this->logActivity('update', 'Presença', $id, 'Atualizou registo de presença #' . $id);

        return redirect()
            ->route("presencas.index")
            ->with("success", "Registo de presença atualizado com sucesso!");
    }
}
