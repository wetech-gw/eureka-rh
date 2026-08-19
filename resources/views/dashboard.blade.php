@extends('layouts.app')

@section('content')
<div class="d-flex">

        @include('partials.sidebar')

    <main class="main-content flex-grow-1 p-5">

    <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="font-serif display-5 fw-normal mb-1">Recursos Humanos</h1>
                    <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — visão geral da equipa</p>
                </div>
                <div class="d-flex gap-2 align-items-center">

                    <a href="{{ route('contact-messages.index') }}" class="btn btn-light bg-white px-3 py-2 text-secondary fw-medium rounded-3 position-relative" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center; gap: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" title="Mensagens de contacto">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        @if(($mensagensNaoLidas ?? 0) > 0)
                            <span class="badge rounded-pill text-white position-absolute" style="background-color: #dc3545; font-size: 10px; top: -8px; right: -8px; min-width: 20px;">{{ $mensagensNaoLidas }}</span>
                        @endif
                    </a>

                    @if(Auth::user()->role === 'Responsável')
                    <a href="{{ route('activity-logs.index') }}" class="btn btn-light bg-white px-3 py-2 text-secondary fw-medium rounded-3 position-relative" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center; gap: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" title="Atividade Recente">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        @if(($atividadesNaoVistas ?? 0) > 0)
                            <span class="badge rounded-pill text-white position-absolute" style="background-color: #dc3545; font-size: 10px; top: -8px; right: -8px; min-width: 20px;">{{ $atividadesNaoVistas }}</span>
                        @endif
                    </a>
                    @endif

                    <button type="button" class="theme-toggle btn btn-light bg-white px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; height: 38px; display: flex; align-items: center; gap: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <svg class="theme-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></svg>
                        <span class="theme-label">Escuro</span>
                    </button>

                    <a href="{{ route('documentos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
                        Registo de Documentos
                    </a>

                    @if(Auth::user()->role !== 'CEO')
                    <a href="{{ route('funcionarios.index') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
                        + Novo Funcionario
                    </a>
                    @endif
                </div>
            </div>

        @include('partials.avisos-ferias')

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Total Funcionario</span>

                    <div class="stat-number">{{ $totalFuncionarios }}</div>

                    @if($novosEsteMes > 0)
                        <span class="text-success small fw-medium d-block mt-2">↑ {{ $novosEsteMes }} este mês</span>
                    @else
                        <span class="text-muted small d-block mt-2">Sem novas contratações</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Presença Hoje</span>
                    <div class="stat-number">
                        {{ $presencasHoje }} <span class="text-muted fs-4">/{{ $totalFuncionarios }}</span>
                    </div>
                    <span class="text-secondary small d-block mt-2">{{ $ausentesHoje }} ausentes</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">Contratos a Expirar</span>

                    <div class="stat-number" style="color: #c94a4a;">{{ $contratosAExpirar }}</div>

                    @if($contratosAExpirar > 0 && !is_null($diasRestantes))
                        @if($diasRestantes == 0)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Atenção: Termina HOJE!</span>
                        @elseif($diasRestantes == 1)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Atenção: Termina AMANHÃ!</span>
                        @elseif($diasRestantes <= 9)
                            <span class="text-danger small fw-bold d-block mt-2">⚠️ Urgente: Termina em {{ $diasRestantes }} dias!</span>
                        @else
                            <span class="text-warning small fw-medium d-block mt-2">↓ Aviso: Termina em {{ $diasRestantes }} dias</span>
                        @endif
                    @else
                        <span class="text-muted small d-block mt-2">Tudo em dia</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4 shadow-sm">
                    <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.02em;">
                        Total Candidatos
                    </span>

                    <div class="stat-number fw-bold fs-3 text-dark">
                        {{ $totalCandidatos ?? 0 }}
                    </div>

                    @if(($candidatosNovosHoje ?? 0) > 0)
                        <span class="text-success small fw-medium d-block mt-2">
                            ↑ +{{ $candidatosNovosHoje }} adicionados hoje
                        </span>
                    @else
                        <span class="text-muted small d-block mt-2">
                            Sem novos registos hoje
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if(($contratoMaisUrgente && $diasRestantes <= 15) || $avaliacoesEmAtraso > 0 || ($candidatosNovosHoje ?? 0) > 0)
            <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
                <span class="text-uppercase text-muted fw-bold me-2" style="font-size: 11px; letter-spacing: 0.05em;">Atenção</span>

                @if($contratoMaisUrgente && $diasRestantes <= 15)
                    <div class="d-flex align-items-center gap-2 bg-light border border-danger-subtle rounded px-2 py-1" style="font-size: 13px;">
                        <span class="rounded-circle bg-danger" style="width: 8px; height: 8px;"></span>
                        <span class="fw-medium">
                            Contrato de <strong class="text-dark">{{ $contratoMaisUrgente->nome }}</strong> expira em {{ $diasRestantes }} dias ·
                            <span class="text-muted fw-normal">Renovação pendente</span>
                        </span>
                    </div>
                @endif

                @if(($candidatosNovosHoje ?? 0) > 0)
                    <div class="d-flex align-items-center gap-2 bg-light border border-info-subtle rounded px-2 py-1 mb-2" style="font-size: 13px;">
                        <span class="rounded-circle" style="width: 8px; height: 8px; background-color: #0dcaf0;"></span>
                        <span class="fw-medium">
                            {{ $candidatosNovosHoje }} {{ $candidatosNovosHoje == 1 ? 'nova candidatura recebida' : 'novas candidaturas recebidas' }} ·
                            <a href="{{ route('candidatos.index') }}" class="text-muted fw-normal text-decoration-none">Verificar Candidatos</a>
                        </span>
                    </div>
                @endif

                @if($avaliacoesEmAtraso > 0)
                    <div class="d-flex align-items-center gap-2 bg-light border border-warning-subtle rounded px-2 py-1" style="font-size: 13px;">
                        <span class="rounded-circle" style="width: 8px; height: 8px; background-color: #fd7e14;"></span>
                        <span class="fw-medium">
                            {{ $avaliacoesEmAtraso }} {{ $avaliacoesEmAtraso == 1 ? 'avaliação' : 'avaliações' }} de desempenho em atraso ·
                            <span class="text-muted fw-normal">Revisão necessária</span>
                        </span>
                    </div>
                @endif
            </div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card-custom shadow-sm p-4 bg-white" style="height: 400px; display: flex; flex-direction: column;">

                    <div class="d-flex justify-content-between align-items-center mb-4" style="flex: 0 0 auto;">
                        <h3 class="fs-5 fw-bold text-dark m-0">Funcionários por Empresa</h3>
                        <a href="{{ route('funcionarios.index') }}" class="text-accent text-decoration-none small fw-medium">Ver todos →</a>
                    </div>

                    @if(count($funcionariosPorEmpresa) > 0)
                        <div style="flex: 1 1 auto; position: relative; min-height: 0;">
                            <canvas id="chartFuncionariosEmpresa"></canvas>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="flex: 1 1 auto;">
                            <p class="text-muted mb-0">Nenhum funcionário ativo registado.</p>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-4">
            <div class="card-custom shadow-sm p-4 bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fs-5 fw-bold text-dark m-0">Ferias — {{ $nomeMes }}</h3>
                    <a href="{{ route('ferias.index') }}" class="text-accent text-decoration-none small fw-medium">Gerir →</a>
                </div>

                <div class="d-grid text-center text-muted fw-medium mb-2" style="grid-template-columns: repeat(7, 1fr); font-size: 11px;">
                    <span>S</span><span>T</span><span>Q</span><span>Q</span><span>S</span><span>S</span><span>D</span>
                </div>

                <div class="d-grid text-center align-items-center text-secondary row-gap-2" style="grid-template-columns: repeat(7, 1fr); font-size: 13px;">

                    @for($i = 1; $i < $diaSemanaInicio; $i++)
                        <span></span>
                    @endfor

                    @for($dia = 1; $dia <= $diasNoMes; $dia++)
                        @if($dia == Carbon\Carbon::now()->day)
                            <span class="rounded-2 p-1 text-white fw-medium" style="background-color: var(--accent);">{{ $dia }}</span>

                        @elseif(in_array($dia, $diasComAusencia))
                            <span class="rounded-2 p-1 fw-bold text-dark" style="background-color: var(--orange-badge);">{{ $dia }}</span>

                        @else
                            <span>{{ $dia }}</span>
                        @endif
                    @endfor
                </div>
                <div style="display:flex; gap:14px; margin-top:14px; padding: 0 4px; flex-wrap: wrap;">
                    <!-- Legenda: Férias -->
                    <div style="display:flex; align-items:center; gap:6px; font-size:11.5px; color:var(--text-secondary);">
                        <div style="width:10px; height:10px; border-radius:3px; background:#fef3c7; border:1px solid #fde68a;"></div>
                        Férias
                    </div>

                    <!-- Legenda: Hoje -->
                    <div style="display:flex; align-items:center; gap:6px; font-size:11.5px; color:var(--text-secondary);">
                        <div style="width:10px; height:10px; border-radius:3px; background:var(--accent);"></div>
                        Hoje
                    </div>
                </div>
            </div>

            <div class="card-custom shadow-sm p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fs-6 fw-bold text-dark m-0">Presença — Hoje</h3>
                    <a class="text-accent text-decoration-none small fw-medium" style="cursor: pointer;">Ver todos →</a>
                </div>

                <div class="d-flex flex-column gap-3" style="max-height: 280px; overflow-y: auto;">
                    @forelse($presencasDetalhadasHoje as $presenca)
                        <div class="d-flex justify-content-between align-items-center py-1">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:28px; height:28px; background-color: #0d9488; font-size: 10px;">
                                    {{ $presenca->iniciais ?? strtoupper(substr($presenca->nome, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 13px;">{{ $presenca->nome }}</div>
                                    <div class="text-muted" style="font-size: 11px;">{{ $presenca->cargo }}</div>
                                </div>
                            </div>

                            <span class="small fw-medium d-flex align-items-center gap-1 {{ $presenca->status_hoje === 'Presente' ? 'text-success' : 'text-warning' }}">
                                <span class="rounded-circle d-inline-block" style="width: 6px; height: 6px; background-color: {{ $presenca->status_hoje === 'Presente' ? 'var(--green-badge)' : '#fd7e14' }};"></span>
                                {{ $presenca->status_hoje }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-muted small py-3">
                            Nenhum registo de ponto de entrada para o dia de hoje.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card-custom shadow-sm p-4 bg-white" style="height: 350px; display: flex; flex-direction: column;">
                    <div class="d-flex justify-content-between align-items-center mb-4" style="flex: 0 0 auto;">
                        <h3 class="fs-5 fw-bold text-dark m-0">Candidaturas Espontâneas — Profissão</h3>
                        <a href="{{ route('candidaturas-espontaneas.index') }}" class="text-accent text-decoration-none small fw-medium">Ver todas →</a>
                    </div>
                    @if(count($candidaturasPorProfissao) > 0)
                        <div style="flex: 1 1 auto; position: relative; min-height: 0;">
                            <canvas id="chartProfissoes"></canvas>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="flex: 1 1 auto;">
                            <p class="text-muted mb-0">Nenhuma candidatura espontânea registada.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </main>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('chartFuncionariosEmpresa');
    if (!ctx) return;

    var labels = {!! json_encode(array_keys($funcionariosPorEmpresa)) !!};
    var data = {!! json_encode(array_values($funcionariosPorEmpresa)) !!};
    var isDark = document.documentElement.getAttribute('data-theme') === 'dark';

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Funcionários',
                data: data,
                backgroundColor: isDark ? 'rgba(45, 212, 191, 0.6)' : 'rgba(13, 148, 136, 0.6)',
                borderColor: isDark ? '#2dd4bf' : '#0d9488',
                borderWidth: 1,
                borderRadius: 6,
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? '#171a21' : '#fff',
                    titleColor: isDark ? '#ececea' : '#111',
                    bodyColor: isDark ? '#a8a8a5' : '#666',
                    borderColor: isDark ? '#262b34' : '#f1f1f0',
                    borderWidth: 1,
                    cornerRadius: 8,
                    padding: 10,
                    callbacks: {
                        label: function(ctx) {
                            return ctx.parsed.y + ' funcionário' + (ctx.parsed.y !== 1 ? 's' : '');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: isDark ? '#6f6f6c' : '#999',
                        font: { size: 12 }
                    },
                    grid: { color: isDark ? '#262b34' : '#f1f1f0' }
                },
                x: {
                    ticks: {
                        color: isDark ? '#a8a8a5' : '#666',
                        font: { size: 12 }
                    },
                    grid: { display: false }
                }
            }
        }
    });

    // Gráfico 2: Candidaturas Espontâneas por Profissão
    var ctx2 = document.getElementById('chartProfissoes');
    if (ctx2) {
        var labels2 = {!! json_encode(array_keys($candidaturasPorProfissao)) !!};
        var data2 = {!! json_encode(array_values($candidaturasPorProfissao)) !!};

        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: labels2,
                datasets: [{
                    data: data2,
                    backgroundColor: [
                        isDark ? 'rgba(45,212,191,0.7)' : 'rgba(13,148,136,0.7)',
                        isDark ? 'rgba(251,191,36,0.7)' : 'rgba(245,158,11,0.7)',
                        isDark ? 'rgba(167,139,250,0.7)' : 'rgba(139,92,246,0.7)',
                        isDark ? 'rgba(244,114,182,0.7)' : 'rgba(236,72,153,0.7)',
                        isDark ? 'rgba(96,165,250,0.7)' : 'rgba(59,130,246,0.7)',
                        isDark ? 'rgba(52,211,153,0.7)' : 'rgba(16,185,129,0.7)',
                        isDark ? 'rgba(251,146,60,0.7)' : 'rgba(249,115,22,0.7)',
                        isDark ? 'rgba(248,113,113,0.7)' : 'rgba(239,68,68,0.7)',
                        isDark ? 'rgba(156,163,175,0.7)' : 'rgba(107,114,128,0.7)',
                        isDark ? 'rgba(34,211,238,0.7)' : 'rgba(6,182,212,0.7)',
                    ],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: isDark ? '#a8a8a5' : '#666',
                            font: { size: 12 },
                            padding: 12,
                            usePointStyle: true,
                            pointStyleWidth: 10,
                        }
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#171a21' : '#fff',
                        titleColor: isDark ? '#ececea' : '#111',
                        bodyColor: isDark ? '#a8a8a5' : '#666',
                        borderColor: isDark ? '#262b34' : '#f1f1f0',
                        borderWidth: 1,
                        cornerRadius: 8,
                        padding: 10,
                        callbacks: {
                            label: function(ctx) {
                                return ' ' + ctx.label + ': ' + ctx.parsed + ' candidatura' + (ctx.parsed !== 1 ? 's' : '');
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush

@endsection
