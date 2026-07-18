<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Formações</title>
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
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        /* NOVO: Estilos para fixar a tabela e ativar o Scroll */
        .table-scrollable-container {
            max-height: 400px; /* Altere este valor para controlar a altura visível da tabela */
            overflow-y: auto;  /* Ativa o scroll vertical */
            overflow-x: auto;  /* Ativa o scroll horizontal se a tela for pequena */
            border: 1px solid #dee2e6;
            border-radius: 8px;
            position: relative;
        }

        .table-scrollable-container table {
            border-collapse: separate; /* Necessário para o efeito sticky funcionar corretamente */
            margin-bottom: 0;
        }

        .table-scrollable-container thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background-color: #f1f3f5 !important; /* Cor de fundo para não sobrepor o texto rolando por baixo */
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.12); /* Garante a linha divisória inferior */
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.05em;
        }

        .badge-curso { background-color: #e6fdfa; color: var(--accent); }
        .badge-concluida { background-color: #d1e7dd; color: #0f5132; }
        .badge-planejada { background-color: #fff3cd; color: #664d03; }

        .modern-search-group { position: relative; max-width: 380px; width: 100%; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; pointer-events: none; }
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>
            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionários
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Licenças
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>
            <a href="{{ route('formacoes.index') }}" class="nav-item-hr active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>
            <a href="{{ route('presencas.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a href="{{ route('folhas.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>
            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>
            <a href="{{ route('candidatos.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>
            <a href="{{ route('financeiro.index')}}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>
            <a href="{{ route('estrategia.index') }}" class="nav-item-hr {{ request()->routeIs('estrategia.index') ? 'active' : '' }}">
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
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3" role="alert">
                <strong>Sucesso!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Plano de Formações</h2>
                <p class="text-accent">Gestão de capacitações, workshops internos e desenvolvimento contínuo da equipa</p>
            </div>
            <div class="d-flex gap-2">
                <div class="modern-search-group">
                    <span class="modern-search-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </span>
                    <input type="text" class="form-control modern-search-input" id="searchFormacao" placeholder="Pesquisar por tema ou entidade...">
                </div>
                <button type="button" class="btn text-white px-3 btn-sm fw-medium rounded-3" style="background-color: var(--accent);" data-bs-toggle="modal" data-bs-target="#modalAddFormacao">
                    ➕ Nova Formação
                </button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Total de Programas</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $totalFormacoes }}</h3>
                    <span class="text-muted small">Cursos registados no sistema</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Em Curso</span>
                    <h3 class="fw-bold my-1 text-accent">{{ $emAndamento }}</h3>
                    <span class="text-muted small">Sessões ativas esta semana</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Concluídas</span>
                    <h3 class="fw-bold my-1 text-success">{{ $concluidas }}</h3>
                    <span class="text-muted small">Histórico de capacitações concluídas</span>
                </div>
            </div>
        </div>

        <div class="card-custom p-4">
            <div class="table-scrollable-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Tema / Curso</th>
                            <th>Entidade Formadora</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Carga Horária</th>
                            <th>Estado Atual</th>
                            <th class="text-center" style="width: 200px;">Alterar para</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formacoes as $f)
                            <tr class="formacao-row">
                                <td class="searchable-tema">
                                    <div class="fw-bold text-dark">{{ $f->tema }}</div>
                                    <span class="text-muted small">Ref: #{{ $f->id }}</span>
                                </td>
                                <td class="fw-medium searchable-entidade">{{ $f->entidade }}</td>
                                <td>{{ \Carbon\Carbon::parse($f->data_inicio)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($f->data_fim)->format('d/m/Y') }}</td>
                                <td>{{ $f->carga_horaria }}h</td>
                                <td>
                                    <span class="badge {{ $f->status == 'Concluída' ? 'badge-concluida' : ($f->status == 'Em Curso' ? 'badge-curso' : 'badge-planejada') }} px-3 py-1.5 rounded-5 fw-medium">
                                        {{ $f->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        @if($f->status !== 'Em Curso' && $f->status !== 'Concluída')
                                            <form action="{{ route('formacoes.alterarEstado', $f->id) }}" method="POST" class="m-0">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Em Curso">
                                                <button type="submit" class="btn btn-sm py-1 px-2 rounded-3 fw-medium" style="background-color: #e6fdfa; color: var(--accent); border: 1px solid #b2f5ea; font-size: 11px;" title="Iniciar Formação">
                                                    ▶ Iniciar
                                                </button>
                                            </form>
                                        @endif

                                        @if($f->status !== 'Concluída')
                                            <form action="{{ route('formacoes.alterarEstado', $f->id) }}" method="POST" class="m-0">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Concluída">
                                                <button type="submit" class="btn btn-sm py-1 px-2 rounded-3 fw-medium" style="background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; font-size: 11px;" title="Concluir Formação">
                                                    ✓ Concluir
                                                </button>
                                            </form>
                                        @endif

                                        @if($f->status === 'Em Curso')
                                            <form action="{{ route('formacoes.alterarEstado', $f->id) }}" method="POST" class="m-0">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Planeada">
                                                <button type="submit" class="btn btn-sm btn-light border py-1 px-2 rounded-3 text-muted" style="font-size: 11px;" title="Mudar para Planeada">
                                                    ↩ Pausar
                                                </button>
                                            </form>
                                        @endif

                                        @if($f->status === 'Concluída')
                                            <span class="text-muted small text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.05em;">
                                                🔒 Finalizado
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="noResultsRow">
                                <td colspan="7" class="text-center text-muted py-4 small">Nenhuma formação registada para o período atual.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalAddFormacao" tabindex="-1" aria-labelledby="modalAddFormacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold m-0" id="modalAddFormacaoLabel">Agendar Nova Formação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('formacoes.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="tema" class="form-label small fw-bold text-muted text-uppercase">Tema / Nome do Curso</label>
                        <input type="text" class="form-control form-control-sm rounded-3" id="tema" name="tema" placeholder="Ex: Liderança Cooperativa ou Git Avançado" required>
                    </div>

                    <div class="mb-3">
                        <label for="entidade" class="form-label small fw-bold text-muted text-uppercase">Entidade Formadora</label>
                        <input type="text" class="form-control form-control-sm rounded-3" id="entidade" name="entidade" placeholder="Ex: Eureka Consulting ou We-Tech" required>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label for="data_inicio" class="form-label small fw-bold text-muted text-uppercase">Data de Início</label>
                            <input type="date" class="form-control form-control-sm rounded-3" id="data_inicio" name="data_inicio" required>
                        </div>
                        <div class="col-6">
                            <label for="data_fim" class="form-label small fw-bold text-muted text-uppercase">Data de Fim</label>
                            <input type="date" class="form-control form-control-sm rounded-3" id="data_fim" name="data_fim" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-1">
                        <div class="col-6">
                            <label for="carga_horaria" class="form-label small fw-bold text-muted text-uppercase">Carga Horária (Horas)</label>
                            <input type="number" class="form-control form-control-sm rounded-3" id="carga_horaria" name="carga_horaria" min="1" placeholder="Ex: 20" required>
                        </div>
                        <div class="col-6">
                            <label for="status" class="form-label small fw-bold text-muted text-uppercase">Estado Inicial</label>
                            <select class="form-select form-select-sm rounded-3" id="status" name="status" required>
                                <option value="Planeada">Planeada</option>
                                <option value="Em Curso">Em Curso</option>
                                <option value="Concluída">Concluída</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light py-2" style="border-radius: 0 0 14px 14px;">
                    <button type="button" class="btn btn-light btn-sm rounded-3 fw-medium" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white btn-sm rounded-3 px-3 fw-medium" style="background-color: var(--accent);">Guardar Formação</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('searchFormacao').addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.formacao-row');
        let hasResults = false;

        rows.forEach(row => {
            const tema = row.querySelector('.searchable-tema').textContent.toLowerCase();
            const entidade = row.querySelector('.searchable-entidade').textContent.toLowerCase();

            if (tema.includes(query) || entidade.includes(query)) {
                row.style.display = '';
                hasResults = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Trata o feedback visual caso não encontre correspondências
        let noResultsRow = document.getElementById('dynamicNoResults');
        if (!hasResults && query !== '') {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'dynamicNoResults';
                noResultsRow.innerHTML = `<td colspan="7" class="text-center text-muted py-4 small">Nenhum resultado encontrado para "${this.value}".</td>`;
                document.querySelector('#tableFormacoes tbody').appendChild(noResultsRow);
            }
        } else if (noResultsRow) {
            noResultsRow.remove();
        }
    });
</script>
</body>
</html>
