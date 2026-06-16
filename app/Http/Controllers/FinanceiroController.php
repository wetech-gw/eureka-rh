<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceiroController extends Controller
{
    public function index()
    {
        // Transações do mês corrente
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Listagem de lançamentos ordenados por data
        $lancamentos = Financeiro::orderBy('data_operacao', 'desc')->get();

        // Cálculos dos Cards Dinâmicos
        $receitasMes = Financeiro::where('tipo', 'Entrada')
            ->whereBetween('data_operacao', [$inicioMes, $fimMes])
            ->sum('valor');

        $despesasMes = Financeiro::where('tipo', 'Saída')
            ->whereBetween('data_operacao', [$inicioMes, $fimMes])
            ->sum('valor');

        // Saldo total acumulado em caixa
        $totalEntradas = Financeiro::where('tipo', 'Entrada')->sum('valor');
        $totalSaidas = Financeiro::where('tipo', 'Saída')->sum('valor');
        $saldoCaixa = $totalEntradas - $totalSaidas;

        // Percentagem de Execução de Budget fictícia/estimada para o dashboard
        $budgetExecutado = $receitasMes > 0 ? round(($despesasMes / $receitasMes) * 100, 1) : 0;

        // Percentagens por Categoria para a barra lateral (Exemplo de agregação)
        $totalDespesasGeral = Financeiro::where('tipo', 'Saída')->sum('valor') ?: 1;
        $categoriasDistribucao = Financeiro::where('tipo', 'Saída')
            ->selectRaw('categoria, SUM(valor) as total')
            ->groupBy('categoria')
            ->get()
            ->mapWithKeys(function ($item) use ($totalDespesasGeral) {
                return [$item->categoria => round(($item->total / $totalDespesasGeral) * 100, 0)];
            });

        return view('financeiro', compact(
            'lancamentos',
            'saldoCaixa',
            'receitasMes',
            'despesasMes',
            'budgetExecutado',
            'categoriasDistribucao'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|in:Entrada,Saída',
            'valor' => 'required|numeric|min:0',
            'data_operacao' => 'required|date',
            'categoria' => 'required|string',
            'metodo_pagamento' => 'nullable|string',
        ]);

        Financeiro::create($validated);

        return redirect()->route('financeiro.index')->with('success', 'Lançamento financeiro registado com sucesso!');
    }

    public function exportar()
    {
        $lancamentos = Financeiro::orderBy('data_operacao', 'desc')->get();
        
        $nomeFicheiro = 'relatorio_financeiro_' . date('Y-m-d_H-i') . '.csv';
        
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$nomeFicheiro",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $colunas = ['ID', 'Descricao', 'Tipo', 'Valor (FCFA)', 'Data Operacao', 'Categoria', 'Metodo Pagamento'];

        $callback = function() use($lancamentos, $colunas) {
            $file = fopen('php://output', 'w');
            
            // Força o Excel a reconhecer a codificação UTF-8 corretamente
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Escreve o cabeçalho
            fputcsv($file, $colunas, ';');

            // Escreve os dados de cada linha
            foreach ($lancamentos as $lancamento) {
                fputcsv($file, [
                    $lancamento->id,
                    $lancamento->descricao,
                    $lancamento->tipo,
                    $lancamento->valor, // Valor numérico puro para facilitar cálculos no Excel
                    \Carbon\Carbon::parse($lancamento->data_operacao)->format('d/m/Y'),
                    $lancamento->categoria,
                    $lancamento->metodo_pagamento ?? 'N/A'
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}