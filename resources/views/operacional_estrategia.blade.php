<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Operacional & Estratégia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        .sidebar { width: 220px; height: 100vh; position: sticky; top: 0; background: white; flex-shrink: 0; overflow-y: auto; }
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .progress { height: 8px; border-radius: 5px; background-color: #e9ecef; }
        .progress-bar { background-color: var(--accent); border-radius: 5px; }
        .badge-critica { background-color: #f8d7da; color: #842029; }
        .badge-alta { background-color: #fff3cd; color: #664d03; }
        .badge-media { background-color: #e2e3e5; color: #41464b; }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar Unificada -->
    <aside class="sidebar border-end p-3 d-flex flex-column">
        <div class="mb-4">
            <div class="font-serif fs-5 fw-normal text-dark lh-1">Eureka<span class="text-accent"> Consulting.</span></div>
            <span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>
        </div>
        <nav class="flex-grow-1">
            <a href="{{ route('dashboard') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>
            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionários
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Ausências
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>
            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>
            <a href="{{ route('presencas.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>
            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>
            <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>
            <a href="{{ route('financeiro.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>
            <a href="{{ route('estrategia.index') }}" class="nav-item-hr active p-2.5 rounded-3 mb-1 {{ request()->routeIs('estrategia.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                Operacional/Estratégia
            </a>
        </nav>
        <div class="pt-3 border-top d-flex align-items-center gap-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:34px; height:34px; background-color: #00796b; font-size:12px;">NS</div>
            <div>
                <div class="fw-bold text-dark" style="font-size: 13px; line-height: 1.2;">Nhana Carla Seide</div>
                <div class="text-muted" style="font-size: 11px;">Gestora de RH</div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <h2 class="fw-bold m-0 text-dark">Operacional & Estratégia</h2>
            <p class="text-muted small mb-0">Planeamento de OKRs, saúde do clima organizacional e execução de metas corporativas da Eureka</p>
        </div>

        <!-- Indicadores de Saúde Organizacional -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Retenção (Turnover Mensal)</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $indicadores->taxa_turnover ?? '0.0' }}%</h3>
                    <span class="text-success small fw-medium">✓ Excelente estabilidade de equipa</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Clima Interno (eNPS)</span>
                    <h3 class="fw-bold my-1 text-accent">+{{ $indicadores->indice_clima_enps ?? '0' }}</h3>
                    <span class="text-muted small">Zona de Qualidade e Satisfação</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Orçamento de Atividades Executado</span>
                    <h4 class="fw-bold my-1 text-dark">
                        {{ number_format($indicadores->orcamento_gasto ?? 0, 2, ',', '.') }}
                    </h4>
                    <div class="text-muted small">Limite Alocado: {{ number_format($indicadores->orcamento_limite ?? 0, 2, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Bloco de Metas / OKRs -->
        <div class="card-custom p-4">
            <h5 class="fw-bold text-dark mb-3">Objetivos Estratégicos & OKRs</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Objetivo / Iniciativa</th>
                            <th>Departamento</th>
                            <th>Prioridade</th>
                            <th style="width: 30%;">Progresso</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($metas as $meta)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 14px;">{{ $meta->titulo }}</div>
                                    <span class="text-muted small">Prazo: {{ \Carbon\Carbon::parse($meta->prazo_limite)->format('d/m/Y') }}</span>
                                </td>
                                <td class="fw-medium text-secondary" style="font-size: 13px;">{{ $meta->departamento }}</td>
                                <td>
                                    <span class="badge {{ $meta->prioridade == 'Crítica' ? 'badge-critica' : ($meta->prioridade == 'Alta' ? 'badge-alta' : 'badge-media') }} px-2.5 py-1 rounded-3">
                                        {{ $meta->prioridade }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress w-100">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $meta->progresso_atual }}%;"></div>
                                        </div>
                                        <span class="fw-bold small text-dark">{{ $meta->progresso_atual }}%</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    @if($meta->progresso_atual < 100)
                                        <form action="{{ route('estrategia.progresso', $meta->id) }}" method="POST" class="m-0">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-light border py-1 px-2.5 rounded-3 fw-medium" style="font-size: 11px;">
                                                📈 +10%
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-success small fw-bold">✓ Concluído</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>