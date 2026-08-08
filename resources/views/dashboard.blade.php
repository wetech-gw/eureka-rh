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

                    <a href="{{ route('documentos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
                        Registo de Documentos
                    </a>

                    <a href="{{ route('funcionarios.index') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
                        + Novo Funcionario
                    </a>
                </div>
            </div>

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
                <div class="card-custom shadow-sm p-4 bg-white" style="height: 630px; display: flex; flex-direction: column;">

                    <div class="d-flex justify-content-between align-items-center mb-4" style="flex: 0 0 auto;">
                        <h3 class="fs-5 fw-bold text-dark m-0">Funcionários</h3>
                        <a href="{{ route('funcionarios.index') }}" class="text-accent text-decoration-none small fw-medium">Ver todos →</a>
                    </div>

                    <div class="table-responsive" style="flex: 1 1 auto; overflow-y: auto; max-height: 100%;">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="sticky-top bg-white" style="z-index: 1; top: 0;">
                                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                                    <th class="pb-3 bg-white">Nome</th>
                                    <th class="pb-3 text-center bg-white">Estado</th>
                                    <th class="pb-3 bg-white">Contrato</th>
                                    <th class="pb-3 bg-white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($colaboradores as $colab)
                                    <tr class="border-bottom">
                                        <td class="py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-medium" style="width:36px; height:36px; background-color: #0d9488;">
                                                    {{ $colab['iniciais'] ?? strtoupper(substr($colab['nome'], 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $colab['nome'] }}</div>
                                                    <div class="text-muted small">{{ $colab['cargo'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if(!is_null($colab['dias_contrato']) && $colab['dias_contrato'] >= 0 && $colab['dias_contrato'] <= 30)
                                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-warning" style="background-color: #fff8e1; color: #b78103 !important;">
                                                    Contrato · {{ $colab['dias_contrato'] }}d
                                                </span>
                                            @elseif(!is_null($colab['dias_contrato']) && $colab['dias_contrato'] < 0)
                                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-danger" style="background-color: #fde8e8; color: #9b1c1c !important;">
                                                    Expirado
                                                </span>
                                            @elseif($colab['estado'] === 'Activo')
                                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-success" style="background-color: #e6fdfa;">
                                                    Activo
                                                </span>
                                            @else
                                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-secondary" style="background-color: #f1f3f5; color: #495057;">
                                                    {{ $colab['estado'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td><span class="text-secondary">{{ $colab['tipo_contrato'] ?? 'Não Especificado' }}</span></td>
                                        <td class="text-muted text-end" style="cursor: pointer;">···</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Nenhum funcionário ativo ou registado de momento.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

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


    </main>
</div>

@endsection
