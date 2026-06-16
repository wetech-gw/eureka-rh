<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // 🟢 CORRIGIDO: Falta importar a Facade DB
use Carbon\Carbon;

class FolhaSalarialController extends Controller
{
    public function index(Request $request)
    {
        $mesSelecionado = $request->get('mes', Carbon::now()->month);
        $anoSelecionado = $request->get('ano', Carbon::now()->year);

        // Listar folhas já geradas
        $folhas = DB::table('folhas_salariais')
            ->join('funcionarios', 'folhas_salariais.funcionario_id', '=', 'funcionarios.id')
            ->select('folhas_salariais.*', 'funcionarios.nome', 'funcionarios.cargo')
            ->where('folhas_salariais.mes', $mesSelecionado)
            ->where('folhas_salariais.ano', $anoSelecionado)
            ->get();

        $totalGastoLiquido = $folhas->sum('salario_liquido');
        $totalPagos = $folhas->where('status', 'Pago')->count();
        $totalPendentes = $folhas->where('status', 'Pendente')->count();

        return view('folha-salarial', compact('folhas', 'totalGastoLiquido', 'totalPagos', 'totalPendentes', 'mesSelecionado', 'anoSelecionado'));
    }

    public function gerarMesInteiro(Request $request)
    {
        $request->validate([
            'mes' => 'required|integer|between:1,12',
            'ano' => 'required|integer'
        ]);

        $mes = $request->mes;
        $ano = $request->ano;

        // 1. Buscar todos os funcionários ativos
        $funcionarios = DB::table('funcionarios')->get();

        foreach ($funcionarios as $emp) {
            
            // Evitar duplicados: verificar se este funcionário já tem folha gerada para este mês/ano
            $existe = DB::table('folhas_salariais')
                ->where('funcionario_id', $emp->id)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->exists();
                
            if ($existe) {
                continue; // Passa para o próximo funcionário se já tiver sido gerado
            }

            // 2. AUTOMAÇÃO: Contar apenas as Faltas Injustificadas na tabela real 'presencas'
            $numFaltas = DB::table('presencas') 
                ->where('funcionario_id', $emp->id)
                ->where('status_hoje', 'Falta Injustificada') 
                ->whereMonth('data', $mes)
                ->whereYear('data', $ano)
                ->count();
            $bruto = $emp->salario_bruto;

            // 3. Cálculos Automáticos de Impostos (Trabalhadores Subordinados)
            $impostoProfissional = 0;
            if ($bruto <= 41667) { $impostoProfissional = 0; }
            elseif ($bruto <= 83333) { $impostoProfissional = 2083; }
            elseif ($bruto <= 208333) { $impostoProfissional = 3750; }
            elseif ($bruto <= 300000) { $impostoProfissional = 7917; }
            elseif ($bruto <= 400500) { $impostoProfissional = 13917; }
            elseif ($bruto <= 750000) { $impostoProfissional = 21927; }
            elseif ($bruto <= 1100000) { $impostoProfissional = 36927; }
            elseif ($bruto <= 1500000) { $impostoProfissional = 58927; }
            else { $impostoProfissional = 88927; }

            $impostoDemocracia = 0;
            if ($bruto <= 41667) { $impostoDemocracia = 500; }
            elseif ($bruto <= 83333) { $impostoDemocracia = 1000; }
            elseif ($bruto <= 208333) { $impostoDemocracia = 2000; }
            elseif ($bruto <= 300000) { $impostoDemocracia = 4000; }
            elseif ($bruto <= 400500) { $impostoDemocracia = 6000; }
            elseif ($bruto <= 750000) { $impostoDemocracia = 10000; }
            elseif ($bruto <= 1100000) { $impostoDemocracia = 15000; }
            elseif ($bruto <= 1500000) { $impostoDemocracia = 17000; }
            else { $impostoDemocracia = 20000; }

            $impostoSelo = $bruto * 0.003;
            $inss = $bruto * 0.08;

            // 4. Salário Líquido de Base (Sem faltas)
            $totalImpostos = $impostoProfissional + $impostoDemocracia + $impostoSelo + $inss;
            $salarioLiquidoBase = $bruto - $totalImpostos;

            // 5. Cálculo Automático do Desconto de Faltas (Alterado para o Salário Bruto)
            $valorPorDiaFalta = $bruto / 30; 
            $descontoFaltas = $valorPorDiaFalta * $numFaltas;

            // 6. Salário Final Líquido
            $salarioLiquidoFinal = $bruto - $impostoProfissional - $impostoDemocracia - $impostoSelo - $inss - $descontoFaltas;

            if ($salarioLiquidoFinal < 0) {
                $salarioLiquidoFinal = 0;
            }

            // Salvar no Banco de Dados
            DB::table('folhas_salariais')->insert([
                'funcionario_id' => $emp->id,
                'mes' => $mes,
                'ano' => $ano,
                'faltas' => $numFaltas,
                'salario_bruto' => $bruto, 
                'imposto_profissional' => $impostoProfissional,
                'imposto_democracia' => $impostoDemocracia,
                'imposto_selo' => $impostoSelo,
                'inss' => $inss,
                'desconto_faltas' => $descontoFaltas,
                'salario_liquido' => $salarioLiquidoFinal, 
                'status' => 'Pendente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Folha de salários do mês gerada com sucesso! Todas as faltas e impostos foram processados.');
    }

    public function alterarStatus($id)
    {
        $folha = DB::table('folhas_salariais')->where('id', $id)->first();
        $novoStatus = $folha->status === 'Pendente' ? 'Pago' : 'Pendente';
        DB::table('folhas_salariais')->where('id', $id)->update(['status' => $novoStatus]);
        return redirect()->back()->with('success', 'Pagamento updated_at!');
    }

    public function exportar(Request $request)
    {
        $mes = $request->input('mes', date('m'));
        $ano = $request->input('ano', date('Y'));

        // 🟢 CORRIGIDO: Mudança de Eloquent (Folha::) para DB::table para herdar os nomes e cargos dos funcionários
        $folhas = DB::table('folhas_salariais')
            ->join('funcionarios', 'folhas_salariais.funcionario_id', '=', 'funcionarios.id')
            ->select('folhas_salariais.*', 'funcionarios.nome', 'funcionarios.cargo')
            ->where('folhas_salariais.mes', $mes)
            ->where('folhas_salariais.ano', $ano)
            ->get();

        $nomeFicheiro = "folha_salarial_{$ano}_{$mes}.csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$nomeFicheiro",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $colunas = [
            'Colaborador', 'Cargo', 'Salario Bruto (XOF)', 
            'Imposto Profissional', 'Imposto Democracia', 'INSS (8%)', 'Imposto Selo', 
            'Faltas (Dias)', 'Desconto Faltas (XOF)', 'Liquido Final (XOF)', 'Estado'
        ];

        $callback = function() use($folhas, $colunas) {
            $file = fopen('php://output', 'w');
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $colunas, ';');

            foreach ($folhas as $f) {
                fputcsv($file, [
                    $f->nome,  // Agora o nome funciona porque fizemos o JOIN
                    $f->cargo, // Agora o cargo funciona porque fizemos o JOIN
                    $f->salario_bruto,
                    $f->imposto_profissional,
                    $f->imposto_democracia,
                    $f->inss,
                    $f->imposto_selo,
                    $f->faltas,
                    $f->desconto_faltas,
                    $f->salario_liquido,
                    $f->status
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}