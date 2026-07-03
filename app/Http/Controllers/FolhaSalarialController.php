<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FolhaSalarialController extends Controller
{
    public function index(Request $request)
    {
        $mesSelecionado = $request->get("mes", Carbon::now()->month);
        $anoSelecionado = $request->get("ano", Carbon::now()->year);

        $folhas = DB::table("folhas_salariais")
            ->join(
                "funcionarios",
                "folhas_salariais.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->select(
                "folhas_salariais.*",
                "funcionarios.nome",
                "funcionarios.cargo",
            )
            ->where("folhas_salariais.mes", $mesSelecionado)
            ->where("folhas_salariais.ano", $anoSelecionado)
            ->get();

        $totalGastoLiquido = $folhas->sum("salario_liquido");
        $totalPagos = $folhas->where("status", "Pago")->count();
        $totalPendentes = $folhas->where("status", "Pendente")->count();

        return view(
            "folha-salarial",
            compact(
                "folhas",
                "totalGastoLiquido",
                "totalPagos",
                "totalPendentes",
                "mesSelecionado",
                "anoSelecionado",
            ),
        );
    }

    public function gerarMesInteiro(Request $request)
    {
        $request->validate([
            "mes" => "required|integer|between:1,12",
            "ano" => "required|integer",
        ]);

        $mes = $request->mes;
        $ano = $request->ano;

        // 1. Buscar todos os funcionários
        $funcionarios = DB::table("funcionarios")->get();

        foreach ($funcionarios as $emp) {
            // Evitar duplicados
            $existe = DB::table("folhas_salariais")
                ->where("funcionario_id", $emp->id)
                ->where("mes", $mes)
                ->where("ano", $ano)
                ->exists();

            if ($existe) {
                continue;
            }

            // 2. AUTOMAÇÃO: Conta apenas onde o status é exatamente 'Falta'
            // As justificadas (ex: 'Falta Justificada') já ficam de fora automaticamente
            $numFaltas = DB::table("presencas")
                ->where("funcionario_id", $emp->id)
                ->where("status_hoje", "Falta")
                ->whereMonth("data", $mes)
                ->whereYear("data", $ano)
                ->count();

            $bruto = $emp->salario_bruto;

            // 3. Cálculos Automáticos de Impostos
            $impostoProfissional = 0;
            if ($bruto <= 41667) {
                $impostoProfissional = 0;
            } elseif ($bruto <= 83333) {
                $impostoProfissional = 2083;
            } elseif ($bruto <= 208333) {
                $impostoProfissional = 3750;
            } elseif ($bruto <= 300000) {
                $impostoProfissional = 7917;
            } elseif ($bruto <= 400500) {
                $impostoProfissional = 13917;
            } elseif ($bruto <= 750000) {
                $impostoProfissional = 21927;
            } elseif ($bruto <= 1100000) {
                $impostoProfissional = 36927;
            } elseif ($bruto <= 1500000) {
                $impostoProfissional = 58927;
            } else {
                $impostoProfissional = 88927;
            }

            $impostoDemocracia = 0;
            if ($bruto <= 41667) {
                $impostoDemocracia = 500;
            } elseif ($bruto <= 83333) {
                $impostoDemocracia = 1000;
            } elseif ($bruto <= 208333) {
                $impostoDemocracia = 2000;
            } elseif ($bruto <= 300000) {
                $impostoDemocracia = 4000;
            } elseif ($bruto <= 400500) {
                $impostoDemocracia = 6000;
            } elseif ($bruto <= 750000) {
                $impostoDemocracia = 10000;
            } elseif ($bruto <= 1100000) {
                $impostoDemocracia = 15000;
            } elseif ($bruto <= 1500000) {
                $impostoDemocracia = 17000;
            } else {
                $impostoDemocracia = 20000;
            }

            $impostoSelo = $bruto * 0.003;
            $inss = $bruto * 0.08;

            // 4. Cálculo Automático do Desconto de Faltas
            $valorPorDiaFalta = $bruto / 30;
            $descontoFaltas = $valorPorDiaFalta * $numFaltas;

            // 5. Salário Final Líquido com o desconto aplicado
            $salarioLiquidoFinal =
                $bruto -
                $impostoProfissional -
                $impostoDemocracia -
                $impostoSelo -
                $inss -
                $descontoFaltas;

            if ($salarioLiquidoFinal < 0) {
                $salarioLiquidoFinal = 0;
            }

            // 6. Salvar no Banco de Dados
            DB::table("folhas_salariais")->insert([
                "funcionario_id" => $emp->id,
                "mes" => $mes,
                "ano" => $ano,
                "faltas" => $numFaltas,
                "salario_bruto" => $bruto,
                "imposto_profissional" => $impostoProfissional,
                "imposto_democracia" => $impostoDemocracia,
                "imposto_selo" => $impostoSelo,
                "inss" => $inss,
                "desconto_faltas" => $descontoFaltas,
                "salario_liquido" => $salarioLiquidoFinal,
                "status" => "Pendente",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
        }

        return redirect()
            ->back()
            ->with(
                "success",
                "Folha de salários gerada com sucesso! As faltas foram computadas e descontadas.",
            );
    }

    // ... manter os métodos alterarStatus e exportar iguais
    public function exportar(Request $request)
    {
        $mes = $request->query("mes");
        $ano = $request->query("ano");

        // 1. Buscar os dados da folha com os nomes dos funcionários
        $folhas = DB::table("folhas_salariais")
            ->join(
                "funcionarios",
                "folhas_salariais.funcionario_id",
                "=",
                "funcionarios.id",
            )
            ->select("funcionarios.nome", "folhas_salariais.*")
            ->where("folhas_salariais.mes", $mes)
            ->where("folhas_salariais.ano", $ano)
            ->get();

        // 2. Configurar os headers para forçar o download do arquivo CSV
        $filename = "folha_salarial_{$mes}_{$ano}.csv";
        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        // 3. Montar o arquivo na memória
        $callback = function () use ($folhas) {
            $file = fopen("php://output", "w");

            // Adicionar a marcação UTF-8 para o Excel reconhecer os acentos
            fprintf($file, chr(0xef) . chr(0xbb) . chr(0xbf));

            // Cabeçalho das colunas no Excel
            fputcsv(
                $file,
                [
                    "Funcionário",
                    "Mês",
                    "Ano",
                    "Faltas",
                    "Salário Bruto",
                    "Imp. Profissional",
                    "Imp. Democracia",
                    "Imp. Selo",
                    "INSS",
                    "Desconto Faltas",
                    "Salário Líquido",
                    "Status",
                ],
                ";",
            );

            // Linhas de dados
            foreach ($folhas as $linha) {
                fputcsv(
                    $file,
                    [
                        $linha->nome,
                        $linha->mes,
                        $linha->ano,
                        $linha->faltas,
                        number_format($linha->salario_bruto, 2, ",", ""),
                        number_format($linha->imposto_profissional, 2, ",", ""),
                        number_format($linha->imposto_democracia, 2, ",", ""),
                        number_format($linha->imposto_selo, 2, ",", ""),
                        number_format($linha->inss, 2, ",", ""),
                        number_format($linha->desconto_faltas, 2, ",", ""),
                        number_format($linha->salario_liquido, 2, ",", ""),
                        $linha->status,
                    ],
                    ";",
                );
            }

            fclose($file);
        };

        // Retorna a resposta de download do Laravel
        return response()->stream($callback, 200, $headers);
    }

    public function alterarStatus(Request $request, $id)
    {
        // 1. Valida se o status enviado é válido (ex: Pago ou Pendente)
        $request->validate([
            "status" => "required|in:Pago,Pendente",
        ]);

        // 2. Atualiza diretamente no banco de dados usando o Query Builder
        $atualizado = DB::table("folhas_salariais")
            ->where("id", $id)
            ->update([
                "status" => $request->status,
                "updated_at" => Carbon::now(),
            ]);

        // 3. Se nenhuma linha foi afetada, significa que o ID não existe
        if (!$atualizado) {
            return redirect()
                ->back()
                ->with("error", "Folha salarial não encontrada.");
        }
        // 4. Retorna para a página anterior com a mensagem de sucesso
        return redirect()
            ->back()
            ->with("success", "Status da folha atualizado com sucesso!");
    }
}
