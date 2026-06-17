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
        
        /* Novos estilos para botões e modais */
        .btn-accent { background-color: var(--accent); color: white; border: none; border-radius: 8px; font-weight: 500; transition: background 0.2s; }
        .btn-accent:hover { background-color: #0b7a70; color: white; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 0.25rem rgba(13, 148, 136, 0.15); }
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
            <a href="{{ route('usuarios.index') }}" class="nav-item-hr">
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

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cabeçalho Melhorado com Botão de Ação -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Operacional & Estratégia</h2>
                <p class="text-muted small mb-0">Planeamento de OKRs, saúde do clima organizacional e execução de metas corporativas da Eureka</p>
            </div>
            <button class="btn btn-accent px-3 py-2 small d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCriarMeta">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Novo Objetivo
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3 mt-2">
            <span class="text-uppercase text-muted fw-bold small" style="letter-spacing: 0.05em;">Métricas Globais do Mês</span>
            <button class="btn btn-sm btn-outline-secondary px-2.5 py-1 rounded-3" data-bs-toggle="modal" data-bs-target="#modalIndicadores" style="font-size: 12px;">
                ⚙️ Atualizar Métricas
            </button>
        </div>
        <!-- Indicadores de Saúde Organizacional -->
        <div class="row g-3 mb-4 align-items-stretch">
    
        <div class="col-md-4">
            <div class="card-custom p-3 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-muted small fw-bold d-block text-uppercase">Retenção (Turnover Mensal)</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $indicadores->taxa_turnover ?? '0.0' }}%</h3>
                </div>
                <div class="mt-2">
                    @if(($indicadores->taxa_turnover ?? 0) <= 5)
                        <span class="text-success small fw-medium">✓ Excelente estabilidade de equipa</span>
                    @elseif(($indicadores->taxa_turnover ?? 0) <= 15)
                        <span class="text-warning small fw-medium" style="color: #d97706 !important;">⚠ Rotatividade moderada; acompanhar</span>
                    @else
                        <span class="text-danger small fw-medium">🚨 Alerta: Rotatividade crítica na equipa!</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom p-3 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-muted small fw-bold d-block text-uppercase">Clima Interno (eNPS)</span>
                    <h3 class="fw-bold my-1 text-accent">
                        @if(($indicadores->indice_clima_enps ?? 0) > 0)+@endif{{ $indicadores->indice_clima_enps ?? '0' }}
                    </h3>
                </div>
                <div class="mt-2">
                    @if(($indicadores->indice_clima_enps ?? 0) >= 75)
                        <span class="text-success small fw-medium">💎 Zona de Excelência (Colaboradores muito felizes)</span>
                    @elseif(($indicadores->indice_clima_enps ?? 0) >= 50)
                        <span class="text-accent small fw-medium">✓ Zona de Qualidade e Satisfação</span>
                    @elseif(($indicadores->indice_clima_enps ?? 0) >= 0)
                        <span class="text-warning small fw-medium" style="color: #d97706 !important;">⚠ Zona de Aperfeiçoamento (Neutro)</span>
                    @else
                        <span class="text-danger small fw-medium">🚨 Zona de Perigo (Clima organizacional crítico!)</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom p-3 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-muted small fw-bold d-block text-uppercase">Orçamento de Atividades Executado</span>
                    <h3 class="fw-bold my-1 text-dark">
                        {{ number_format($indicadores->orcamento_gasto ?? 0, 2, ',', '.') }}
                    </h3>
                </div>
                <div class="mt-2">
                    <div class="text-muted small mb-1">Limite Alocado: {{ number_format($indicadores->orcamento_limite ?? 0, 2, ',', '.') }}</div>
                    
                    @if(($indicadores->orcamento_gasto ?? 0) > ($indicadores->orcamento_limite ?? 0))
                        <span class="text-danger small fw-bold">❌ Orçamento Estourado! Limite ultrapassado.</span>
                    @elseif(($indicadores->orcamento_gasto ?? 0) >= (($indicadores->orcamento_limite ?? 0) * 0.9))
                        <span class="text-warning small fw-medium" style="color: #d97706 !important;">⚠ Atenção: Próximo ao limite máximo (90%+)</span>
                    @else
                        <span class="text-success small fw-medium">✓ Despesas controladas e dentro do teto</span>
                    @endif
                </div>
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
                            <th style="width: 30%;">Progresso Atual</th>
                            <th class="text-end">Ações</th>
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
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        @if($meta->progresso_atual < 100)
                                            <form action="{{ route('estrategia.progresso', $meta->id) }}" method="POST" class="m-0">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-light border py-1 px-2.5 rounded-3 fw-medium" style="font-size: 11px;" title="Incrementar 10%">
                                                    📈 +10%
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-success small fw-bold me-1">✓ Concluído</span>
                                        @endif
                                        
                                        <!-- Botão para Editar e ver Detalhes -->
                                        <button class="btn btn-sm btn-light border p-1 rounded-3" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditarMeta"
                                                data-id="{{ $meta->id }}"
                                                data-titulo="{{ $meta->titulo }}"
                                                data-departamento="{{ $meta->departamento }}"
                                                data-prioridade="{{ $meta->prioridade }}"
                                                data-prazo="{{ $meta->prazo_limite }}"
                                                data-progresso="{{ $meta->progresso_atual }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- ================= MODAL: ADICIONAR NOVO PLANEAMENTO ================= -->
<div class="modal fade" id="modalCriarMeta" tabindex="-1" aria-labelledby="modalCriarMetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark" id="modalCriarMetaLabel">Novo Objetivo Estratégico</h5>
                <button type="button" class="btn-close" data-bs-replace data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('estrategia.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Título do Objetivo / OKR</label>
                        <input type="text" name="titulo" class="form-control rounded-3" placeholder="Ex: Otimizar UX do portal Bissau-Digital" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Departamento</label>
                            <input type="text" name="departamento" class="form-control rounded-3" placeholder="Ex: Tecnologia" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Prioridade</label>
                            <select name="prioridade" class="form-select rounded-3" required>
                                <option value="Média">Média</option>
                                <option value="Alta">Alta</option>
                                <option value="Crítica">Crítica</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Prazo Limite</label>
                            <input type="date" name="prazo_limite" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Progresso Inicial (%)</label>
                            <input type="number" name="progresso_atual" min="0" max="100" class="form-control rounded-3" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3" style="border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-2 rounded-3 text-secondary fw-medium" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-accent px-4 py-2 rounded-3">Salvar Planeamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL: EDITAR / DETALHES DO PLANEAMENTO ================= -->
<div class="modal fade" id="modalEditarMeta" tabindex="-1" aria-labelledby="modalEditarMetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark" id="modalEditarMetaLabel">Modificar Objetivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarMeta" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Título do Objetivo</label>
                        <input type="text" name="titulo" id="edit_titulo" class="form-control rounded-3" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Departamento</label>
                            <input type="text" name="departamento" id="edit_departamento" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Prioridade</label>
                            <select name="prioridade" id="edit_prioridade" class="form-select rounded-3" required>
                                <option value="Média">Média</option>
                                <option value="Alta">Alta</option>
                                <option value="Crítica">Crítica</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Prazo Limite</label>
                            <input type="date" name="prazo_limite" id="edit_prazo" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Progresso Atual (%)</label>
                            <input type="number" name="progresso_atual" id="edit_progresso" min="0" max="100" class="form-control rounded-3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3" style="border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-2 rounded-3 text-secondary fw-medium" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-sm btn-accent px-4 py-2 rounded-3">Atualizar Dados</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================= MODAL: ATUALIZAR INDICADORES DE SAÚDE ================= -->
<div class="modal fade" id="modalIndicadores" tabindex="-1" aria-labelledby="modalIndicadoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark" id="modalIndicadoresLabel">Atualizar Saúde Organizacional</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('estrategia.indicadores.update') }}" method="POST">
                @csrf
                <div class="modal-body px-4 pb-4">
                    <p class="text-muted small mb-3">Introduza as métricas consolidadas recolhidas pelas auditorias de clima e relatórios financeiros.</p>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Turnover Mensal (%)</label>
                            <input type="number" step="0.1" name="taxa_turnover" class="form-control rounded-3" value="{{ $indicadores->taxa_turnover ?? '0.0' }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Clima Interno (eNPS)</label>
                            <input type="number" name="indice_clima_enps" class="form-control rounded-3" min="-100" max="100" value="{{ $indicadores->indice_clima_enps ?? '0' }}" required>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Orçamento Gasto (€)</label>
                            <input type="number" step="0.01" name="orcamento_gasto" class="form-control rounded-3" value="{{ $indicadores->orcamento_gasto ?? '0.00' }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase">Limite Alocado (€)</label>
                            <input type="number" step="0.01" name="orcamento_limite" class="form-control rounded-3" value="{{ $indicadores->orcamento_limite ?? '0.00' }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3" style="border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-2 rounded-3 text-secondary fw-medium" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-sm btn-accent px-4 py-2 rounded-3">Gravar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script JS corrigido para apontar para a rota operacional-estratégia
    const modalEditar = document.getElementById('modalEditarMeta');
    if (modalEditar) {
        modalEditar.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            
            // Extrair dados dos atributos data-* do botão clicado
            const id = button.getAttribute('data-id');
            const titulo = button.getAttribute('data-titulo');
            const departamento = button.getAttribute('data-departamento');
            const prioridade = button.getAttribute('data-prioridade');
            const prazo = button.getAttribute('data-prazo');
            const progresso = button.getAttribute('data-progresso');

            // Atualizar os inputs do Modal
            document.getElementById('edit_titulo').value = titulo;
            document.getElementById('edit_departamento').value = departamento;
            document.getElementById('edit_prioridade').value = prioridade;
            document.getElementById('edit_prazo').value = prazo;
            document.getElementById('edit_progresso').value = progresso;

            // 🟢 CORREÇÃO AQUI: Garante o caminho exato que declarou no web.php
            document.getElementById('formEditarMeta').action = `/operacional-estrategia/${id}`;
        });
    }
</script>
</body>
</html>