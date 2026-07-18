<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Férias & Ausências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }

        .wrapper { display: flex; width: 100%; min-height: 100vh; }

        /* Menu Lateral Fixo */
        .sidebar {
            width: 220px;
            height: 100vh;
            position: sticky;
            top: 0;
            background: white;
            flex-shrink: 0;
            overflow-y: auto;
        }

        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }

        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }

        /* Fixar Cabeçalho da Tabela e Ativar o Scroll */
        .table-scrollable-container {
            max-height: 400px; /* Altura limite para rolagem */
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            position: relative;
        }

        .table-scrollable-container table {
            border-collapse: separate;
            margin-bottom: 0;
        }

        .table-scrollable-container thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background-color: #f1f3f5 !important;
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.12);
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.05em;
        }

        .badge-aprovado { background-color: #d1e7dd; color: #0f5132; }
        .badge-pendente { background-color: #fff3cd; color: #664d03; }
        .badge-rejeitado { background-color: #f8d7da; color: #842029; }

        .form-label-compact { font-size: 11px; font-weight: 600; color: #495057; margin-bottom: 2px; }
        .form-control-compact { padding: 4px 8px; font-size: 13px; border-radius: 6px; }
        .modal-section-title { font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; color: var(--accent); margin-bottom: 8px; font-weight: 700; }

        /* Correção e Alinhamento da Barra de Pesquisa */
        .modern-search-group { position: relative; width: 300px; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; height: 38px; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; pointer-events: none; z-index: 4; }
    </style>
</head>
<body>

<div class="wrapper">

    <aside class="sidebar border-end p-3 d-flex flex-column">
        <div class="mb-4">
            <div class="font-serif fs-5 fw-normal text-dark lh-1">Eureka<span class="text-accent"> Consulting.</span></div>
            <span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>
        </div>

        <nav class="flex-grow-1">
            <a href="{{ route('dashboard') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>
            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionários
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Licenças
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>
            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>
            <a href="{{ route('presencas.index')}}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('folhas.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>
            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento.index') ? 'active' : '' }}">
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
            <a href="{{ route('estrategia.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('estrategia.index') ? 'active' : '' }}">
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

        <div class="row align-items-center mb-4 g-3">
            <div class="col-12 col-md-5">
                <h2 class="fw-bold m-0 text-dark">Férias & Licenças</h2>
                <p class="text-accent mb-0">Eureka Consulting - Controlo de Disponibilidade e Faltas</p>
            </div>

            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2">
                <div class="modern-search-group">
                    <i class="bi bi-search modern-search-icon"></i>
                    <input type="text" class="form-control modern-search-input" id="searchEmployee" placeholder="Pesquisar funcionário em férias ou licenças...">
                </div>

                <button class="btn text-white px-4 fw-medium rounded-3" style="background-color: var(--accent); height: 38px;" data-bs-toggle="modal" data-bs-target="#modalLancar">
                    + Registar Férias / Licença
                </button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Pedidos Aprovados</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $pedidosAprovados }}</h3>
                    <span class="text-muted small">Total de pedidos aprovados</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Pedidos Pendentes</span>
                    <h3 class="fw-bold my-1 text-warning">{{ $pedidosPendentes }}</h3>
                    <span class="text-muted small">Aguardam validação dos RH</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Pedidos Rejeitados</span>
                    <h3 class="fw-bold my-1 text-danger">{{ $pedidosRejeitados }}</h3>
                    <span class="text-muted small font-medium">Total de pedidos rejeitados</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card-custom p-4">
            <div class="table-scrollable-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Funcionário</th>
                            <th>Tipo</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Dias</th>
                            <th>Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registos as $r)
                        <tr class="border-bottom funcionario-row"
                            data-nome="{{ strtolower($r->nome ?? '') }}"
                            data-telefone="{{ $r->telefone ?? '' }}">
                                <td>
                                    <div class="fw-bold text-dark">{{ $r->nome }}</div>
                                    <span class="text-muted small">{{ $r->cargo }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $r->tipo == 'Férias' ? 'bg-info text-dark' : 'bg-secondary' }}">
                                        {{ $r->tipo }}
                                    </span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($r->data_inicio)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($r->data_fim)) }}</td>
                                <td class="fw-bold">{{ $r->dias }}</td>
                                <td>
                                    <span class="badge badge-{{ strtolower($r->estado_pedido) }} px-3 py-1.5 rounded-5 fw-medium">
                                        {{ $r->estado_pedido }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalVerRegisto{{ $r->id }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#495057" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </button>
                                        <button class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#modalEditarRegisto{{ $r->id }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Nenhum registo de ausência ou férias encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalLancar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h6 class="modal-title fw-bold m-0">Registar Férias ou Licença</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('ferias.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label class="form-label-compact">Colaborador *</label>
                            <select name="funcionario_id" class="form-select form-control-compact" required>
                                <option value="">Selecione o Funcionário...</option>
                                @foreach($funcionarios as $func)
                                    <option value="{{ $func->id }}">{{ $func->nome }} ({{ $func->cargo }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Tipo de Registo *</label>
                            <select name="tipo" class="form-select form-control-compact" required>
                                <option value="Férias">Férias</option>
                                <option value="Licença">Licença</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Estado Inicial</label>
                            <select name="estado_pedido" class="form-select form-control-compact">
                                <option value="Pendente">Pendente</option>
                                <option value="Aprovado">Aprovado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Data de Início *</label>
                            <input type="date" name="data_inicio" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Data de Fim *</label>
                            <input type="date" name="data_fim" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-compact">Observações / Motivo</label>
                            <textarea name="observacoes" rows="2" class="form-control form-control-compact" placeholder="Ex: Gozo de férias regulamentares ou Motivo de doença..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-1">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Gravar Registo</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($registos as $r)
    <div class="modal fade" id="modalVerRegisto{{ $r->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header text-white" style="background-color: #0d9488;">
                    <h6 class="modal-title fw-bold m-0">Detalhes de férias ou licença</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3" style="font-size: 13px;">
                    <p><strong>Funcionário:</strong> {{ $r->nome }}</p>
                    <p><strong>Tipo:</strong> {{ $r->tipo }}</p>
                    <p><strong>Período:</strong> {{ date('d/m/Y', strtotime($r->data_inicio)) }} até {{ date('d/m/Y', strtotime($r->data_fim)) }}</p>
                    <p><strong>Total de Dias:</strong> {{ $r->dias }} dia(s)</p>
                    <p><strong>Estado do Pedido:</strong> {{ $r->estado_pedido }}</p>
                    <p><strong>Observações:</strong> {{ $r->observacoes ?? 'Sem observações gravadas.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarRegisto{{ $r->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header text-white" style="background-color: #0d9488;">
                    <h6 class="modal-title fw-bold m-0">Modificar Registo: {{ $r->nome }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('ferias.update', $r->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label-compact">Tipo</label>
                                <select name="tipo" class="form-select form-control-compact">
                                    <option value="Férias" {{ $r->tipo == 'Férias' ? 'selected' : '' }}>Férias</option>
                                    <option value="Licença" {{ $r->tipo == 'Licença' ? 'selected' : '' }}>Licença</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-compact">Estado do Pedido</label>
                                <select name="estado_pedido" class="form-select form-control-compact">
                                    <option value="Aprovado" {{ $r->estado_pedido == 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                                    <option value="Pendente" {{ $r->estado_pedido == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="Rejeitado" {{ $r->estado_pedido == 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-compact">Data Início</label>
                                <input type="date" name="data_inicio" value="{{ $r->data_inicio }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-compact">Data Fim</label>
                                <input type="date" name="data_fim" value="{{ $r->data_fim }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-compact">Observações</label>
                                <textarea name="observacoes" rows="2" class="form-control form-control-compact">{{ $r->observacoes }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-1">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Atualizar Registo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputPesquisa = document.getElementById('searchEmployee');
    // Seleciona as linhas dentro do container com rolagem
    const linhasFuncionarios = document.querySelectorAll('.table-scrollable-container tbody tr.funcionario-row');

    if (inputPesquisa) {
        inputPesquisa.addEventListener('input', function() {
            const termoPesquisa = this.value.toLowerCase().trim();

            linhasFuncionarios.forEach(row => {
                const nameElement = row.querySelector('.fw-bold.text-dark');
                const nomeText = nameElement ? nameElement.textContent.toLowerCase() : '';

                const nomeAttr = row.getAttribute('data-nome') || '';
                const telefone = row.getAttribute('data-telefone') || '';

                if (termoPesquisa === '') {
                    row.style.setProperty('display', '', 'important');
                } else if (nomeText.includes(termoPesquisa) || nomeAttr.includes(termoPesquisa) || telefone.includes(termoPesquisa)) {
                    row.style.setProperty('display', '', 'important');
                } else {
                    row.style.setProperty('display', 'none', 'important');
                }
            });
        });

        inputPesquisa.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    }
});
</script>
</body>
</html>
