<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Traits\LogsActivity;

class FeriasController extends Controller
{
    use LogsActivity;
    private const MESES_MINIMOS_PARA_GOZO = 6;

    private const TIPO_FERIAS_ANUAIS = 'Férias anuais';

    private const ESTADO_APROVADO = 'Aprovado';

    private const ESTADO_PENDENTE = 'Pendente';

    private const PAGAMENTO_NAO_APLICAVEL = 'Não aplicável';

    private const PAGAMENTO_PENDENTE = 'Pendente';

    private const PAGAMENTO_PAGO = 'Pago';

    /** Janela (em dias) para a contagem regressiva antes do início das férias. */
    private const JANELA_INICIO_FERIAS_DIAS = 30;

    /** Janela (em dias) para a contagem regressiva antes do fim das férias. */
    private const JANELA_FIM_FERIAS_DIAS = 5;

    /** Duração máxima da notificação de pedido aprovado. */
    private const HORAS_VALIDADE_AVISO_APROVADO = 24;

    public function index()
    {
        $avisosFerias = $this->obterAvisosFerias();

        $pedidosAprovados = DB::table('ausencias')
            ->where('estado_pedido', 'Aprovado')
            ->count();

        $pedidosPendentes = DB::table('ausencias')
            ->where('estado_pedido', 'Pendente')
            ->count();

        $pedidosRejeitados = DB::table('ausencias')
            ->where('estado_pedido', 'Rejeitado')
            ->count();

        $funcionarios = DB::table('funcionarios')
            ->where('estado', 'Activo')
            ->orderBy('nome', 'asc')
            ->get()
            ->map(function ($f) {
                $saldo = $this->calcularSaldoFerias((int) $f->id, $f->data_inicio_contrato);
                $f->ferias_total_dias = $saldo['total'];
                $f->ferias_gozadas_dias = $saldo['gozados'];
                $f->ferias_disponiveis_dias = $saldo['disponiveis'];
                return $f;
            });

        $registos = DB::table('ausencias')
            ->join('funcionarios', 'ausencias.funcionario_id', '=', 'funcionarios.id')
            ->select(
                'ausencias.*',
                'funcionarios.nome',
                'funcionarios.cargo',
                'funcionarios.salario_bruto',
                'funcionarios.data_inicio_contrato'
            )
            ->orderBy('ausencias.data_inicio', 'desc')
            ->get()
            ->map(function ($r) {
                $saldo = $this->calcularSaldoFerias((int) $r->funcionario_id, $r->data_inicio_contrato);
                $r->ferias_disponiveis_dias = $saldo['disponiveis'];
                $r->valor_total_subsidio = (float) ($r->valor_total_subsidio ?? 0);
                $r->saldo_subsidio = (float) ($r->saldo_subsidio ?? 0);

                return $r;
            });

        return view(
            'ferias',
            compact(
                'pedidosAprovados',
                'pedidosPendentes',
                'pedidosRejeitados',
                'funcionarios',
                'registos',
                'avisosFerias',
            ),
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:Férias anuais,Licença de maternidade,Licença de paternidade,Licença por falecimento de familiar de 1.º grau,Licença por falecimento de familiar de 2.º grau,Licença por casamento civil,Licença sem vencimento,Outra licença',
            'estado_pedido' => 'nullable|in:Pendente,Aprovado,Rejeitado',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'direito_subsidio_ferias' => 'nullable|boolean',
            'valor_subsidio_ferias' => 'nullable|numeric|min:0',
            'valor_total_subsidio' => 'nullable|numeric|min:0',
            'estado_pagamento_subsidio' => 'nullable|in:Não aplicável,Pendente,Pago',
            'observacoes' => 'nullable|string',
        ], [
            'valor_subsidio_ferias.min' => 'O valor solicitado não pode ser negativo.',
            'valor_subsidio_ferias.numeric' => 'O valor solicitado deve ser numérico.',
            'valor_total_subsidio.min' => 'O valor total do subsídio não pode ser negativo.',
        ]);

        $dataInicio = Carbon::parse($data['data_inicio']);
        $dataFim = Carbon::parse($data['data_fim']);
        $dias = $this->contarDiasUteis($dataInicio, $dataFim);

        $funcionario = DB::table('funcionarios')
            ->where('id', $data['funcionario_id'])
            ->first();

        if ($data['tipo'] === self::TIPO_FERIAS_ANUAIS) {
            $mesesCompletos = Carbon::parse($funcionario->data_inicio_contrato)->diffInMonths(Carbon::today());

            if ($mesesCompletos < self::MESES_MINIMOS_PARA_GOZO) {
                return redirect()->back()->withErrors([
                    'data_inicio' => 'Este colaborador ainda não cumpre o período mínimo para gozo de férias.',
                ])->withInput();
            }

            $saldo = $this->calcularSaldoFerias((int) $data['funcionario_id'], $funcionario->data_inicio_contrato);
            if (($data['estado_pedido'] ?? self::ESTADO_PENDENTE) === self::ESTADO_APROVADO && $dias > $saldo['disponiveis']) {
                return redirect()->back()->withErrors([
                    'data_fim' => 'Saldo de férias insuficiente para aprovar este pedido.',
                ])->withInput();
            }
        }

        $subsidio = $this->calcularDadosSubsidioFerias($data);
        if ($subsidio['errors']) {
            return redirect()->back()->withErrors($subsidio['errors'])->withInput();
        }

        $payload = [
            'funcionario_id' => $data['funcionario_id'],
            'tipo' => $data['tipo'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
            'dias' => $dias,
            'estado_pedido' => $data['estado_pedido'] ?? self::ESTADO_PENDENTE,
            'observacoes' => $data['observacoes'] ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (Schema::hasColumn('ausencias', 'direito_subsidio_ferias')) {
            $payload['direito_subsidio_ferias'] = $subsidio['direito'];
        }
        if (Schema::hasColumn('ausencias', 'valor_subsidio_ferias')) {
            $payload['valor_subsidio_ferias'] = $subsidio['valor_solicitado'];
        }
        if (Schema::hasColumn('ausencias', 'valor_total_subsidio')) {
            $payload['valor_total_subsidio'] = $subsidio['valor_total'];
        }
        if (Schema::hasColumn('ausencias', 'saldo_subsidio')) {
            $payload['saldo_subsidio'] = $subsidio['saldo'];
        }
        if (Schema::hasColumn('ausencias', 'estado_pagamento_subsidio')) {
            $payload['estado_pagamento_subsidio'] = $subsidio['estado_pagamento'];
        }

        DB::table('ausencias')->insert($payload);

        $nomeFunc = $funcionario->nome ?? 'desconhecido';
        $this->logActivity('create', 'Férias/Ausência', null, 'Registou férias de ' . $nomeFunc . ' (' . $data['tipo'] . ')');

        return redirect()->back()->with('success', 'Registo de ausência/férias gravado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tipo' => 'required|in:Férias anuais,Licença de maternidade,Licença de paternidade,Licença por falecimento de familiar de 1.º grau,Licença por falecimento de familiar de 2.º grau,Licença por casamento civil,Licença sem vencimento,Outra licença',
            'estado_pedido' => 'required|in:Aprovado,Pendente,Rejeitado',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'direito_subsidio_ferias' => 'nullable|boolean',
            'valor_subsidio_ferias' => 'nullable|numeric|min:0',
            'valor_total_subsidio' => 'nullable|numeric|min:0',
            'estado_pagamento_subsidio' => 'nullable|in:Não aplicável,Pendente,Pago',
            'observacoes' => 'nullable|string',
        ], [
            'valor_subsidio_ferias.min' => 'O valor solicitado não pode ser negativo.',
            'valor_subsidio_ferias.numeric' => 'O valor solicitado deve ser numérico.',
            'valor_total_subsidio.min' => 'O valor total do subsídio não pode ser negativo.',
        ]);

        $registo = DB::table('ausencias')->where('id', $id)->first();
        if (! $registo) {
            return redirect()->back()->withErrors(['geral' => 'Registo não encontrado.']);
        }

        $dataInicio = Carbon::parse($data['data_inicio']);
        $dataFim = Carbon::parse($data['data_fim']);
        $dias = $this->contarDiasUteis($dataInicio, $dataFim);

        $funcionario = DB::table('funcionarios')->where('id', $registo->funcionario_id)->first();

        if ($data['tipo'] === self::TIPO_FERIAS_ANUAIS && $data['estado_pedido'] === self::ESTADO_APROVADO) {
            $saldo = $this->calcularSaldoFerias((int) $registo->funcionario_id, $funcionario->data_inicio_contrato, (int) $id);
            if ($dias > $saldo['disponiveis']) {
                return redirect()->back()->withErrors([
                    'data_fim' => 'Saldo de férias insuficiente para aprovar este pedido.',
                ])->withInput();
            }
        }

        $subsidio = $this->calcularDadosSubsidioFerias($data);
        if ($subsidio['errors']) {
            return redirect()->back()->withErrors($subsidio['errors'])->withInput();
        }

        $payload = [
            'tipo' => $data['tipo'],
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
            'dias' => $dias,
            'estado_pedido' => $data['estado_pedido'],
            'observacoes' => $data['observacoes'] ?? null,
            'updated_at' => Carbon::now(),
        ];

        if (Schema::hasColumn('ausencias', 'direito_subsidio_ferias')) {
            $payload['direito_subsidio_ferias'] = $subsidio['direito'];
        }
        if (Schema::hasColumn('ausencias', 'valor_subsidio_ferias')) {
            $payload['valor_subsidio_ferias'] = $subsidio['valor_solicitado'];
        }
        if (Schema::hasColumn('ausencias', 'valor_total_subsidio')) {
            $payload['valor_total_subsidio'] = $subsidio['valor_total'];
        }
        if (Schema::hasColumn('ausencias', 'saldo_subsidio')) {
            $payload['saldo_subsidio'] = $subsidio['saldo'];
        }
        if (Schema::hasColumn('ausencias', 'estado_pagamento_subsidio')) {
            $payload['estado_pagamento_subsidio'] = $subsidio['estado_pagamento'];
        }

        DB::table('ausencias')
            ->where('id', $id)
            ->update($payload);

        $nomeFunc = $funcionario->nome ?? 'desconhecido';
        $this->logActivity('update', 'Férias/Ausência', $id, 'Atualizou registo de férias de ' . $nomeFunc);

        return redirect()->back()->with('success', 'Registo atualizado com sucesso!');
    }

    private function calcularDadosSubsidioFerias(array $data): array
    {
        $estadoPedido = $data['estado_pedido'] ?? self::ESTADO_PENDENTE;
        $temDireito = $data['tipo'] === self::TIPO_FERIAS_ANUAIS
            && $estadoPedido === self::ESTADO_APROVADO;

        if (! $temDireito) {
            return [
                'direito' => false,
                'valor_solicitado' => 0,
                'valor_total' => 0,
                'saldo' => 0,
                'estado_pagamento' => self::PAGAMENTO_NAO_APLICAVEL,
                'errors' => null,
            ];
        }

        $valorTotal = (float) ($data['valor_total_subsidio'] ?? 0);
        $valorSolicitado = (float) ($data['valor_subsidio_ferias'] ?? 0);
        $estadoPagamento = $data['estado_pagamento_subsidio'] ?? self::PAGAMENTO_PENDENTE;
        $errors = $this->validarLevantamentoSubsidio(
            $valorSolicitado,
            $valorTotal,
            $estadoPagamento
        );

        if ($errors) {
            return [
                'direito' => true,
                'valor_solicitado' => $valorSolicitado,
                'valor_total' => $valorTotal,
                'saldo' => max(0, $valorTotal - $valorSolicitado),
                'estado_pagamento' => $estadoPagamento,
                'errors' => $errors,
            ];
        }

        if ($estadoPagamento === self::PAGAMENTO_NAO_APLICAVEL) {
            $estadoPagamento = $valorSolicitado > 0
                ? self::PAGAMENTO_PAGO
                : self::PAGAMENTO_PENDENTE;
        }

        return [
            'direito' => true,
            'valor_solicitado' => $valorSolicitado,
            'valor_total' => $valorTotal,
            'saldo' => max(0, $valorTotal - $valorSolicitado),
            'estado_pagamento' => $estadoPagamento,
            'errors' => null,
        ];
    }

    private function validarLevantamentoSubsidio(float $valorSolicitado, float $saldoDisponivel, string $estadoPagamento): ?array
    {
        if ($valorSolicitado < 0) {
            return ['valor_subsidio_ferias' => 'O valor solicitado não pode ser negativo.'];
        }

        if ($saldoDisponivel <= 0 && ($valorSolicitado > 0 || $estadoPagamento === self::PAGAMENTO_PAGO)) {
            return ['valor_subsidio_ferias' => 'Não existe saldo disponível do subsídio de férias para processar este pagamento.'];
        }

        if ($valorSolicitado > $saldoDisponivel) {
            return ['valor_subsidio_ferias' => 'O valor solicitado é superior ao saldo disponível do subsídio de férias.'];
        }

        if ($estadoPagamento === self::PAGAMENTO_PAGO && $valorSolicitado <= 0) {
            return ['valor_subsidio_ferias' => 'Informe um valor a levantar para processar o pagamento do subsídio de férias.'];
        }

        return null;
    }

    private function calcularValorTotalSubsidioFerias(object $funcionario): float
    {
        return round($this->obterSalarioLiquidoMensal($funcionario) * 2, 2);
    }

    private function obterSalarioLiquidoMensal(object $funcionario): float
    {
        if (
            Schema::hasTable('folhas_salariais')
            && Schema::hasColumn('folhas_salariais', 'salario_liquido')
        ) {
            $salarioLiquido = DB::table('folhas_salariais')
                ->where('funcionario_id', $funcionario->id)
                ->orderByDesc('ano')
                ->orderByDesc('mes')
                ->orderByDesc('id')
                ->value('salario_liquido');

            if ($salarioLiquido !== null) {
                return max(0, (float) $salarioLiquido);
            }
        }

        return $this->calcularSalarioLiquidoBase((float) ($funcionario->salario_bruto ?? 0));
    }

    private function calcularSalarioLiquidoBase(float $salarioBruto): float
    {
        if ($salarioBruto <= 0) {
            return 0;
        }

        $impostoProfissional = 0;
        if ($salarioBruto <= 41667) {
            $impostoProfissional = 0;
        } elseif ($salarioBruto <= 83333) {
            $impostoProfissional = 2083;
        } elseif ($salarioBruto <= 208333) {
            $impostoProfissional = 3750;
        } elseif ($salarioBruto <= 300000) {
            $impostoProfissional = 7917;
        } elseif ($salarioBruto <= 400500) {
            $impostoProfissional = 13917;
        } elseif ($salarioBruto <= 750000) {
            $impostoProfissional = 21927;
        } elseif ($salarioBruto <= 1100000) {
            $impostoProfissional = 36927;
        } elseif ($salarioBruto <= 1500000) {
            $impostoProfissional = 58927;
        } else {
            $impostoProfissional = 88927;
        }

        $impostoDemocracia = 0;
        if ($salarioBruto <= 41667) {
            $impostoDemocracia = 500;
        } elseif ($salarioBruto <= 83333) {
            $impostoDemocracia = 1000;
        } elseif ($salarioBruto <= 208333) {
            $impostoDemocracia = 2000;
        } elseif ($salarioBruto <= 300000) {
            $impostoDemocracia = 4000;
        } elseif ($salarioBruto <= 400500) {
            $impostoDemocracia = 6000;
        } elseif ($salarioBruto <= 750000) {
            $impostoDemocracia = 10000;
        } elseif ($salarioBruto <= 1100000) {
            $impostoDemocracia = 15000;
        } elseif ($salarioBruto <= 1500000) {
            $impostoDemocracia = 17000;
        } else {
            $impostoDemocracia = 20000;
        }

        $impostoSelo = $salarioBruto * 0.003;
        $inss = $salarioBruto * 0.08;

        return max(0, $salarioBruto - $impostoProfissional - $impostoDemocracia - $impostoSelo - $inss);
    }

    /**
     * Conta apenas os dias úteis (segunda a sexta) de um intervalo de férias,
     * sem considerar fins de semana como dias de gozo.
     */
    private function contarDiasUteis(Carbon $dataInicio, Carbon $dataFim): int
    {
        $inicio = $dataInicio->copy()->startOfDay();
        $fim = $dataFim->copy()->startOfDay();

        $dias = 0;
        while ($inicio->lte($fim)) {
            if ($inicio->isWeekday()) {
                $dias++;
            }
            $inicio->addDay();
        }

        return $dias;
    }

    private function calcularSaldoFerias(int $funcionarioId, string $dataInicioContrato, ?int $ignorarRegistoId = null): array
    {
        $mesesCompletos = Carbon::parse($dataInicioContrato)->diffInMonths(Carbon::today());
        $total = $mesesCompletos * 2;

        $queryGozados = DB::table('ausencias')
            ->where('funcionario_id', $funcionarioId)
            ->where('tipo', 'Férias anuais')
            ->where('estado_pedido', 'Aprovado');

        if ($ignorarRegistoId) {
            $queryGozados->where('id', '!=', $ignorarRegistoId);
        }

        $gozados = (int) $queryGozados->sum('dias');

        return [
            'total' => max(0, $total),
            'gozados' => max(0, $gozados),
            'disponiveis' => max(0, $total - $gozados),
        ];
    }

    /**
     * Gera notificações de férias:
     *  - 'aprovado': pedido aprovado (visível no máximo 24 horas após a aprovação);
     *  - 'entrada': contagem regressiva até ao início das férias (até 30 dias antes);
     *  - 'fim': contagem regressiva até ao fim das férias (últimos 5 dias).
     */
    public function obterAvisosFerias(): array
    {
        $avisos = [];
        $hoje = Carbon::today();

        // ---- Aviso de aprovação (máximo 24 horas) ----
        $aprovados = DB::table('ausencias')
            ->join('funcionarios', 'ausencias.funcionario_id', '=', 'funcionarios.id')
            ->where('ausencias.tipo', self::TIPO_FERIAS_ANUAIS)
            ->where('ausencias.estado_pedido', self::ESTADO_APROVADO)
            ->where('ausencias.updated_at', '>=', Carbon::now()->subHours(self::HORAS_VALIDADE_AVISO_APROVADO))
            ->select(
                'ausencias.id',
                'ausencias.data_inicio',
                'ausencias.data_fim',
                'ausencias.dias',
                'ausencias.funcionario_id',
                'funcionarios.nome',
                'funcionarios.cargo'
            )
            ->orderByDesc('ausencias.updated_at')
            ->get();

        foreach ($aprovados as $a) {
            $avisos[] = [
                'tipo' => 'aprovado',
                'ausencia_id' => $a->id,
                'funcionario_id' => $a->funcionario_id,
                'nome' => $a->nome,
                'cargo' => $a->cargo,
                'data_inicio' => $a->data_inicio,
                'data_fim' => $a->data_fim,
                'dias' => (int) $a->dias,
            ];
        }

        // ---- Contagem regressiva para o início das férias ----
        $proximosInicios = DB::table('ausencias')
            ->join('funcionarios', 'ausencias.funcionario_id', '=', 'funcionarios.id')
            ->where('ausencias.tipo', self::TIPO_FERIAS_ANUAIS)
            ->where('ausencias.estado_pedido', self::ESTADO_APROVADO)
            ->whereDate('ausencias.data_inicio', '>=', $hoje->toDateString())
            ->whereDate('ausencias.data_inicio', '<=', $hoje->copy()->addDays(self::JANELA_INICIO_FERIAS_DIAS)->toDateString())
            ->select(
                'ausencias.data_inicio',
                'ausencias.funcionario_id',
                'funcionarios.nome',
                'funcionarios.cargo'
            )
            ->orderBy('ausencias.data_inicio', 'asc')
            ->get();

        foreach ($proximosInicios as $a) {
            $diasParaInicio = (int) $hoje->startOfDay()->diffInDays(Carbon::parse($a->data_inicio)->startOfDay());

            $avisos[] = [
                'tipo' => 'entrada',
                'funcionario_id' => $a->funcionario_id,
                'nome' => $a->nome,
                'cargo' => $a->cargo,
                'data_alvo' => $a->data_inicio,
                'dias' => max(0, $diasParaInicio),
            ];
        }

        // ---- Contagem regressiva para o fim das férias ----
        $proximosFins = DB::table('ausencias')
            ->join('funcionarios', 'ausencias.funcionario_id', '=', 'funcionarios.id')
            ->where('ausencias.tipo', self::TIPO_FERIAS_ANUAIS)
            ->where('ausencias.estado_pedido', self::ESTADO_APROVADO)
            ->whereDate('ausencias.data_fim', '>=', $hoje->toDateString())
            ->whereDate('ausencias.data_fim', '<=', $hoje->copy()->addDays(self::JANELA_FIM_FERIAS_DIAS)->toDateString())
            ->select(
                'ausencias.data_fim',
                'ausencias.funcionario_id',
                'funcionarios.nome',
                'funcionarios.cargo'
            )
            ->orderBy('ausencias.data_fim', 'asc')
            ->get();

        foreach ($proximosFins as $a) {
            $diasParaFim = (int) $hoje->startOfDay()->diffInDays(Carbon::parse($a->data_fim)->startOfDay());

            $avisos[] = [
                'tipo' => 'fim',
                'funcionario_id' => $a->funcionario_id,
                'nome' => $a->nome,
                'cargo' => $a->cargo,
                'data_alvo' => $a->data_fim,
                'dias' => max(0, $diasParaFim),
            ];
        }

        // Aprovações primeiro, depois contagens regressivas por proximidade
        usort($avisos, function ($a, $b) {
            if ($a['tipo'] === 'aprovado') {
                return -1;
            }
            if ($b['tipo'] === 'aprovado') {
                return 1;
            }

            return $a['dias'] <=> $b['dias'];
        });

        return $avisos;
    }
}
