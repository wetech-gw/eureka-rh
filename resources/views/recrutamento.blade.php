<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Recrutamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        
        /* Menu Lateral Fixo Padrão */
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
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        
        .form-label-compact { font-size: 11px; font-weight: 600; color: #495057; margin-bottom: 2px; }
        .form-control-compact { padding: 4px 8px; font-size: 13px; border-radius: 6px; }
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
                Férias & Ausências
            </a>
            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>
            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>
            <a href="{{ route('presencas.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>
            <a href="{{ route('folhas.index') }}" class="nav-item-hr {{ request()->routeIs('folhas.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>
            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr active">
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
            <a href="{{ route('financeiro.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                Financeiro
            </a>
            {{-- <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Relatórios
            </a> --}}
            <a href="{{ route('estrategia.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('estrategia.index') ? 'active' : '' }}">
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
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Gestão de Recrutamentos</h2>
                <p class="text-muted small mb-0">Abertura de vagas e acompanhamento dos processos de seleção da empresa</p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Processos Ativos</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $recrutamentos->where('status', 'Ativo')->count() }}</h3>
                    <span class="text-muted small">Vagas abertas a receber candidaturas</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Localização Principal</span>
                    <h3 class="fw-bold my-1 text-teal" style="color: var(--accent);">Bissau</h3>
                    <span class="text-muted small">Sede operacional da recruta</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="small fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-custom p-4 shadow-sm">
                    <div class="pb-2 mb-3 border-bottom">
                        <h6 class="fw-bold text-dark m-0">Lançar Nova Recruta</h6>
                    </div>
                    <form action="{{ route('recrutamento.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-2">
                            <label class="form-label-compact">Título da Vaga *</label>
                            <input type="text" name="titulo_vaga" class="form-control form-control-compact" placeholder="Ex: Agente de Data Center" required>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label class="form-label-compact">Departamento *</label>
                                <input type="text" name="departamento" class="form-control form-control-compact" placeholder="Ex: TI, RH, Direção" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label-compact">Tipo de Contrato *</label>
                                <input type="text" name="tipo_contrato" class="form-control form-control-compact" placeholder="Ex: Full-time, Estágio" required>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label class="form-label-compact">Nº de Vagas *</label>
                                <input type="number" name="vagas_disponiveis" class="form-control form-control-compact" value="1" min="1" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label-compact">Data Limite *</label>
                                <input type="date" name="data_limite" class="form-control form-control-compact" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label-compact">Descrição da Vaga *</label>
                            <textarea name="descricao_vaga" class="form-control form-control-compact" rows="3" placeholder="Funções e responsabilidades..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-compact">Requisitos Mínimos *</label>
                            <textarea name="requisitos" class="form-control form-control-compact" rows="3" placeholder="Formação acadêmica, ferramentas técnicas..." required></textarea>
                        </div>

                        <button type="submit" class="btn text-white w-100 fw-medium btn-sm p-2 rounded-3" style="background-color: var(--accent);">
                            Publicar Recruta
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-custom p-4 shadow-sm">
                    <div class="pb-2 mb-3 border-bottom">
                        <h6 class="fw-bold text-dark m-0">Vagas Ativas em Processo</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Vaga Aberta</th>
                                    <th>Departamento</th>
                                    <th>Contrato</th>
                                    <th>Data Limite</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recrutamentos as $vaga)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $vaga->titulo_vaga }}</div>
                                            <span class="text-muted small">{{ $vaga->vagas_disponiveis }} vaga(s) de direito</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-3 fw-medium">
                                                {{ $vaga->departamento }}
                                            </span>
                                        </td>
                                        <td class="fw-medium text-secondary">{{ $vaga->tipo_contrato }}</td>
                                        <td class="text-danger fw-bold small">{{ date('d/m/Y', strtotime($vaga->data_limite)) }}</td>
                                        
                                    <td class="text-center">
                                        @if(($vaga->status ?? 'Ativo') == 'Ativo')
                                            <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #d1e7dd; color: #0f5132;">
                                                Ativo
                                            </span>
                                        @else
                                            <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #f8d7da; color: #842029;">
                                                Expirado
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if(($vaga->status ?? 'Ativo') == 'Ativo')
                                            <form action="{{ route('recrutamento.alterarEstado', $vaga->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Expirado"> <button type="submit" class="btn btn-sm btn-outline-warning fw-medium px-2 py-1" onclick="return confirm('Tens a certeza que queres fechar esta vaga?')">
                                                    <i class="fa-solid fa-folder-minus me-1"></i> Fechar
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('recrutamento.alterarEstado', $vaga->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Ativo"> <button type="submit" class="btn btn-sm btn-outline-success fw-medium px-2 py-1">
                                                    <i class="fa-solid fa-folder-plus me-1"></i> Reativar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4 small">Nenhum processo de recrutamento lançado até ao momento.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>