<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeriasController extends Controller
{
    public function index()
    {
        $hoje = Carbon::today()->toDateString();

        // 1. Ajustado para contar os pedidos aprovados
        $pedidosAprovados = DB::table("ausencias")
            ->where("estado_pedido", "Aprovado") // Conta apenas os pedidos aprovados (ferias, licença)
            ->count();

        // 2. Ajustado para contar os pedidos pendentes
        $pedidosPendentes = DB::table("ausencias")
            ->where("estado_pedido", "Pendente") // Conta apenas os pedidos pendentes
            ->count();

        // 3. Ajustado para contar os rejeitados
        $pedidosRejeitados = DB::table("ausencias")
            ->where("estado_pedido", "Rejeitado") // Conta apenas os pedidos rejeitados
            ->count();

        // 4. Lista de Funcionários para o select do formulário
        $funcionarios = DB::table("funcionarios")
            ->where("estado", "Activo")
            ->orderBy("nome", "asc")
            ->get();

        // 5. Listagem Principal de Férias e Ausências
        $registos = DB::table("ausencias")
            ->join(
                "funcionarios",
                "ausencias.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->select("ausencias.*", "funcionarios.nome", "funcionarios.cargo")
            ->orderBy("ausencias.data_inicio", "desc")
            ->get();

        return view(
            "ferias",
            compact(
                "pedidosAprovados",
                "pedidosPendentes",
                "pedidosRejeitados",
                "funcionarios",
                "registos",
            ),
        );
    }

    public function store(Request $request)
    {
        $dataInicio = Carbon::parse($request->data_inicio);
        $dataFim = Carbon::parse($request->data_fim);
        $dias = $dataInicio->diffInDays($dataFim) + 1;

        DB::table("ausencias")->insert([
            "funcionario_id" => $request->funcionario_id,
            "tipo" => $request->tipo,
            "data_inicio" => $request->data_inicio,
            "data_fim" => $request->data_fim,
            "dias" => $dias,
            "estado_pedido" => $request->estado_pedido ?? "Pendente",
            "observacoes" => $request->observacoes,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        return redirect()
            ->back()
            ->with(
                "success",
                "Registo de ausência/férias gravado com sucesso!",
            );
    }

    public function update(Request $request, $id)
    {
        $dataInicio = Carbon::parse($request->data_inicio);
        $dataFim = Carbon::parse($request->data_fim);
        $dias = $dataInicio->diffInDays($dataFim) + 1;

        DB::table("ausencias")
            ->where("id", $id)
            ->update([
                "tipo" => $request->tipo,
                "data_inicio" => $request->data_inicio,
                "data_fim" => $request->data_fim,
                "dias" => $dias,
                "estado_pedido" => $request->estado_pedido,
                "observacoes" => $request->observacoes,
                "updated_at" => Carbon::now(),
            ]);

        return redirect()
            ->back()
            ->with("success", "Registo atualizado com sucesso!");
    }
}
