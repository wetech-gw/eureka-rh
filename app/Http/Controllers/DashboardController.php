<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Garante a ligação à Base de Dados
use Illuminate\Support\Facades\Auth; // 🟢 ADICIONADO: Garante o acesso ao utilizador logado
use Carbon\Carbon; // Garante a gestão de datas do Laravel

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================================
        // 🟢 ADICIONADO: SEGURANÇA E PERSONALIZAÇÃO DE ACESSO
        // ==========================================================
        $user = Auth::user(); // Pega no utilizador autenticado (Nhana ou Assistente)

        $hoje = Carbon::now()->toDateString();

        // 1. CARDS SUPERIORES (Cálculos Dinâmicos)
        $totalFuncionarios = DB::table("funcionarios")
            ->where("estado", "Activo")
            ->count();

        $presencasHoje = DB::table("presencas")
            ->whereDate("data", Carbon::today()->toDateString())
            ->whereIn("status_hoje", ["Presente", "Atrasado"])
            ->count();

        $ausentesHoje = max(0, $totalFuncionarios - $presencasHoje);

        $contratosAExpirar = DB::table("funcionarios")
            ->whereNotNull("data_fim_contrato")
            ->whereBetween("data_fim_contrato", [
                $hoje,
                Carbon::now()->addDays(30)->toDateString(),
            ])
            ->count();

        // Procura o contrato mais urgente para o Alerta Vermelho
        $contratoMaisUrgente = DB::table("funcionarios")
            ->whereNotNull("data_fim_contrato")
            ->where("data_fim_contrato", ">=", $hoje)
            ->orderBy("data_fim_contrato", "asc")
            ->first();

        $diasRestantes = null;
        if ($contratoMaisUrgente) {
            $diasRestantes = Carbon::now()
                ->startOfDay()
                ->diffInDays(
                    Carbon::parse(
                        $contratoMaisUrgente->data_fim_contrato,
                    )->startOfDay(),
                    false,
                );
        }

        // 2. AVALIAÇÕES EM ATRASO
        $avaliacoesEmAtraso = DB::table("avaliacoes")
            ->where("estado", "Pendente")
            ->whereDate("data_avaliacao", "<", $hoje)
            ->count();

        // 3. AUXILIAR DE NOVAS CONTRATAÇÕES (Mês Atual)
        $novosEsteMes = DB::table("funcionarios")
            ->whereMonth("created_at", Carbon::now()->month)
            ->whereYear("created_at", Carbon::now()->year)
            ->count();

        // 4. LÓGICA DE CANDIDATOS
        $totalCandidatos = DB::table("candidatos")->count();

        $candidatosNovosHoje = DB::table("candidatos")
            ->whereDate("created_at", Carbon::today()->toDateString())
            ->count();

        // 5. TABELA CENTRAL (Com cálculo de dias de contrato individual)
        $colaboradores = DB::table("funcionarios")
            ->get()
            ->map(function ($f) use ($hoje) {
                // Conta as faltas reais
                $faltasReais = DB::table("ausencias")
                    ->where("funcionario_id", $f->id)
                    ->count();

                // CALCULA OS DIAS RESTANTES DO CONTRATO DESTE FUNCIONÁRIO
                $diasRestantesContrato = null;
                if ($f->data_fim_contrato) {
                    $diasRestantesContrato = Carbon::now()
                        ->startOfDay()
                        ->diffInDays(
                            Carbon::parse($f->data_fim_contrato)->startOfDay(),
                            false, // false permite números negativos se o contrato já expirou
                        );
                }

                return [
                    "id" => $f->id,
                    "nome" => $f->nome,
                    "cargo" => $f->cargo,
                    "estado" => $f->estado,
                    "tipo_contrato" => $f->tipo_contrato,
                    "tipo_trabalhador" => $f->tipo_trabalhador,
                    "salario_bruto" => $f->salario_bruto,
                    "faltas" => $faltasReais,
                    "dias_contrato" => $diasRestantesContrato,
                ];
            });

        // 6. DADOS PARA O MINI-CALENDÁRIO E PRESENÇAS DETALHADAS
        $mesAtualObjeto = Carbon::now();
        $nomeMes = ucfirst(
            $mesAtualObjeto->locale("pt")->translatedFormat("F"),
        );
        $diasNoMes = $mesAtualObjeto->daysInMonth;
        $diaSemanaInicio = $mesAtualObjeto->startOfMonth()->dayOfWeekIso;

        // Dias numéricos com ausências registadas neste mês
        $diasComAusencia = DB::table("ausencias")
            ->whereMonth("data_inicio", $mesAtualObjeto->month)
            ->whereYear("data_inicio", $mesAtualObjeto->year)
            ->pluck("data_inicio")
            ->map(function ($data) {
                return Carbon::parse($data)->day;
            })
            ->toArray();

        // Lista de quem bateu o ponto no dia de hoje
        $presencasDetalhadasHoje = DB::table("presencas")
            ->join(
                "funcionarios",
                "presencas.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->whereDate("presencas.data", Carbon::today()->toDateString())
            ->select(
                "funcionarios.nome",
                "funcionarios.cargo",
                "presencas.status_hoje",
            )
            ->get();

        // 7. DADOS FINANCEIROS (Cards inferiores)
        $saldoCaixa =
            DB::table("financeiros")
                ->selectRaw(
                    "COALESCE(SUM(CASE WHEN tipo = 'Entrada' THEN valor ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN tipo = 'Saída' THEN valor ELSE 0 END), 0) as saldo",
                )
                ->value("saldo") ?? 0;

        $receitasMes =
            DB::table("financeiros")
                ->where("tipo", "Entrada")
                ->whereMonth("data_operacao", Carbon::now()->month)
                ->whereYear("data_operacao", Carbon::now()->year)
                ->sum("valor") ?? 0;

        $despesasMes =
            DB::table("financeiros")
                ->where("tipo", "Saída")
                ->whereMonth("data_operacao", Carbon::now()->month)
                ->whereYear("data_operacao", Carbon::now()->year)
                ->sum("valor") ?? 0;

        $budgetExecutado =
            $receitasMes > 0 ? round(($despesasMes / $receitasMes) * 100) : 0;

        // 8. RETORNO SEGURO PARA A VIEW (Com as variáveis incluídas)
        return view(
            "dashboard",
            compact(
                "user",
                "totalFuncionarios",
                "presencasHoje",
                "ausentesHoje",
                "contratosAExpirar",
                "contratoMaisUrgente",
                "diasRestantes",
                "avaliacoesEmAtraso",
                "novosEsteMes",
                "totalCandidatos",
                "candidatosNovosHoje",
                "colaboradores",
                "nomeMes",
                "diasNoMes",
                "diaSemanaInicio",
                "diasComAusencia",
                "presencasDetalhadasHoje",
                "saldoCaixa",
                "receitasMes",
                "despesasMes",
                "budgetExecutado",
            ),
        );
    }
}
