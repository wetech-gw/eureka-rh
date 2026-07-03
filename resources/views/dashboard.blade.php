@extends('layouts.app')

@section('content')
<div class="d-flex">

        <aside class="sidebar border-end p-3 d-flex flex-column" style="min-height: 100vh;">
        <div class="mb-4">
            <div class="font-serif fs-5 fw-normal text-dark lh-1">Eureka<span class="text-accent"> Consulting.</span></div>
            <span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>
        </div>

        <nav class="flex-grow-1">
            <a href="{{ route('dashboard') }}" class="nav-item-hr active p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionarios
            </a>

            <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Licenças
            </a>

            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>

            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes.index') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>

            <a href="{{ route('presencas.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>

            <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('folhas.index') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>

            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento.index') ? 'active' : '' }}" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>

            <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>

            <a href="{{ route('financeiro.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>

            <a href="{{ route('estrategia.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('estrategia.index') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                Operacional/Estratégia
            </a>

            <a href="{{ route('usuarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Utilizadores / Acessos
            </a>
        </nav>
        <div class="pt-2">
            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                @csrf
                <button type="submit" class="btn btn-link text-danger p-0 border-0 text-decoration-none d-flex align-items-center gap-1 small fw-bold" style="font-size: 11px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Terminar Sessão
                </button>
            </form>
        </div>
        <div class="pt-3 border-top d-flex align-items-center gap-2 mt-auto">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold text-uppercase"
                style="width:36px; height:36px; background-color: #00796b; font-size:11px; letter-spacing: 0.05em;">
                @php
                    $words = explode(' ', Auth::user()->name);
                    $initials = (count($words) >= 2) ? $words[0][0] . end($words)[0] : $words[0][0];
                @endphp
                {{ $initials }}
            </div>

            <div class="overflow-hidden">
                <div class="fw-bold text-dark text-truncate" style="font-size: 13px; line-height: 1.2;" title="{{ Auth::user()->name }}">
                    {{ Auth::user()->name }}
                </div>
                <div class="text-muted text-capitalize text-truncate" style="font-size: 11px;" title="{{ Auth::user()->role }}">
                    {{ Auth::user()->role }}
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content flex-grow-1 p-5">

        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h1 class="font-serif display-5 fw-normal mb-1">Recursos Humanos</h1>
                <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — visão geral da equipa</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('documentos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none;">
                    Registo de Documentos
                </a>
                <a href="{{ route('funcionarios.index') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none;">+ Novo Funcionario</a>
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

                    @if(($novosHoje ?? 0) > 0)
                        <span class="text-success small fw-medium d-block mt-2">
                            ↑ +{{ $novosHoje }} adicionados hoje
                        </span>
                    @else
                        <span class="text-muted small d-block mt-2">
                            Sem novos registos hoje
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if(($contratoMaisUrgente && $diasRestantes <= 15) || $avaliacoesEmAtraso > 0)
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

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Produtividade</span>
                    <div class="display-6 text-dark mb-3">92<span class="fs-4 text-muted">%</span></div>
                    <div class="progress rounded-pill" style="height: 4px;">
                        <div class="progress-bar" style="width: 92%; background-color: var(--accent);"></div>
                    </div>
                    <span class="text-muted small d-block mt-2">Média da equipa</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Novas Contratações</span>
                    <div class="display-6 text-dark mb-3">3 <span class="fs-6 text-muted">maio</span></div>
                    <div class="d-flex align-items-end gap-1.5" style="height: 24px;">
                        <div class="mini-bar" style="height: 30%"></div>
                        <div class="mini-bar" style="height: 50%"></div>
                        <div class="mini-bar" style="height: 40%"></div>
                        <div class="mini-bar" style="height: 70%"></div>
                        <div class="mini-bar" style="height: 60%"></div>
                        <div class="mini-bar active" style="height: 90%"></div>
                        <div class="mini-bar" style="height: 20%"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-custom p-4 shadow-sm bg-white">
                    <span class="text-secondary fw-normal d-block mb-1" style="font-size: 14px;">Taxa de Retenção de Recursos Humanos</span>
                    <div class="display-6 text-dark mb-3">94<span class="fs-4 text-muted">%</span></div>
                    <div class="progress rounded-pill" style="height: 4px;">
                        <div class="progress-bar" style="width: 94%; background-color: var(--accent);"></div>
                    </div>
                    <span class="text-success small fw-medium d-block mt-2">↑ 2% vs ano anterior</span>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection
