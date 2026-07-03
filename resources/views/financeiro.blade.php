<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }

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
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
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
            <a href="{{ route('dashboard') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionarios
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1">
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
            <a href="{{ route('presencas.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1">
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
            <a href="{{ route('recrutamento.index') }}"
            class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>
            <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2">
                <!-- Ícone Candidatos (Corrigido viewBox e tamanho do desenho) -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>
            <a href="{{ route('financeiro.index')}}" class="nav-item-hr active p-2.5 rounded-3 mb-1">
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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show p-2 small mb-3" role="alert">
                <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Gestão Financeira Corporativa</h2>
                <p class="text-muted small mb-0">Controlo de orçamentos, custos de RH, despesas operacionais e fluxos de caixa</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('financeiro.exportar') }}" class="btn btn-light border fw-medium px-3 shadow-sm d-inline-flex align-items-center" style="font-size: 14px; height: 38px;">
                    <i class="fa-solid fa-file-export me-1"></i> Exportar Relatório
                </a>
                <button type="button" class="btn text-white fw-medium shadow-sm px-3" style="background-color: #0d9488; font-size: 14px; border: none; height: 38px;" data-bs-toggle="modal" data-bs-target="#addTransacaoModal">
                    <i class="fa-solid fa-plus me-1"></i> Registar Lançamento
                </button>
            </div>
        </div>

        <div class="row g-2 mb-4 row-cols-2 row-cols-md-4 row-cols-lg-4">
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #0d9488;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Saldo em Caixa</span>
                        <h4 class="fw-bold m-0 text-dark">{{ number_format($saldoCaixa, 0, ',', '.') }} FCFA</h4>
                    </div>
                    <div class="bg-teal-subtle rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #e6fdfa; color: #0d9488;">
                        <i class="fa-solid fa-wallet" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #10b981;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Receitas (Mês)</span>
                        <h4 class="fw-bold m-0 text-success">+{{ number_format($receitasMes, 0, ',', '.') }} FCFA</h4>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-arrow-up-long" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #ef4444;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Despesas (Mês)</span>
                        <h4 class="fw-bold m-0 text-danger">-{{ number_format($despesasMes, 0, ',', '.') }} FCFA</h4>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-arrow-down-long" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #6b21a8;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Budget Executado</span>
                        <h4 class="fw-bold m-0" style="color: #6b21a8;">{{ $budgetExecutado }}%</h4>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #f3e8ff; color: #6b21a8;">
                        <i class="fa-solid fa-chart-pie" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card-custom p-4 shadow-sm h-100">
                    <div class="pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-dark m-0">Últimos Lançamentos Financeiros</h6>
                        <span class="text-muted small">Histórico Geral</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Descrição / Categoria</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Método</th>
                                    <th class="text-end">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lancamentos as $lancamento)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $lancamento->descricao }}</div>
                                            <span class="text-muted small d-block">{{ $lancamento->categoria }}</span>
                                        </td>
                                        <td>
                                            @if($lancamento->tipo == 'Entrada')
                                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1 rounded-5 fw-medium" style="font-size: 10px;">Entrada</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1 rounded-5 fw-medium" style="font-size: 10px;">Saída</span>
                                            @endif
                                        </td>
                                        <td class="small text-muted">{{ \Carbon\Carbon::parse($lancamento->data_operacao)->format('d/m/Y') }}</td>
                                        <td class="small text-secondary">{{ $lancamento->metodo_pagamento ?? 'Não especificado' }}</td>
                                        <td class="text-end fw-bold {{ $lancamento->tipo == 'Entrada' ? 'text-success' : 'text-danger' }}">
                                            {{ $lancamento->tipo == 'Entrada' ? '+' : '-' }}{{ number_format($lancamento->valor, 0, ',', '.') }} FCFA
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted small py-4">Nenhum lançamento financeiro registado até ao momento.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom p-4 shadow-sm h-100">
                    <div class="pb-2 mb-3 border-bottom">
                        <h6 class="fw-bold text-dark m-0">Alocação de Despesas</h6>
                    </div>

                    <p class="text-muted small mb-3">Distribuição real de despesas acumuladas por categoria:</p>

                    {{-- Loop dinâmico pelas categorias vindas do banco --}}
                    @forelse($categoriasDistribucao as $categoria => $porcentagem)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small fw-medium text-dark mb-1">
                                <span>{{ $categoria }}</span>
                                <span>{{ $porcentagem }}%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                {{-- Usando bg-secondary como padrão para as barras --}}
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $porcentagem }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small text-center my-4">Nenhuma despesa registrada ainda.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="addTransacaoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold">Novo Lançamento Financeiro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('financeiro.store') }}" method="POST">
                @csrf
                <div class="modal-body text-start p-4">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Tipo de Movimentação</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="tipoEntrada" value="Entrada" checked>
                                <label class="form-check-label small" for="tipoEntrada">Entrada (Receita)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="tipoSaida" value="Saída">
                                <label class="form-check-label small" for="tipoSaida">Saída (Despesa)</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Descrição</label>
                        <input type="text" name="descricao" class="form-control border-secondary-subtle" placeholder="Ex: Pagamento Fornecedor X" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Valor (FCFA)</label>
                            <input type="number" name="valor" step="0.01" class="form-control border-secondary-subtle" placeholder="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Data Operação</label>
                            <input type="date" name="data_operacao" class="form-control border-secondary-subtle" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label small fw-bold text-secondary">Categoria</label>
                        <input
                            type="text"
                            name="categoria"
                            id="categoria"
                            class="form-control border-secondary-subtle"
                            placeholder="Digite o nome da categoria..."
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Método de Pagamento</label>
                        <select name="metodo_pagamento" class="form-select border-secondary-subtle">
                            <option value="Transferência Bancária">Transferência Bancária</option>
                            <option value="Depósito Direto">Depósito Direto</option>
                            <option value="Dinheiro / Caixa">Dinheiro / Caixa</option>
                            <option value="Cartão Corporativo">Cartão Corporativo</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #0d9488;">Salvar Registro</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
