<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        
        /* Layout Sidebar Integrado */
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        .sidebar { width: 220px; min-height: 100vh; background: white; flex-shrink: 0; }
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        
        .badge-activo { background-color: #e6fdfa; color: #0f5132; }
        .badge-inactivo { background-color: #f8d7da; color: #842029; }
        .badge-suspenso { background-color: #fff3cd; color: #664d03; }

        /* Ajustes de Densidade para Formulários Compactos */
        .form-label-compact { font-size: 11px; font-weight: 600; color: #495057; margin-bottom: 2px; }
        .form-control-compact { padding: 4px 8px; font-size: 13px; border-radius: 6px; }
        .modal-section-title { font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; color: var(--accent); margin-bottom: 8px; font-weight: 700; }
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
            <a href="{{ route('funcionarios.index') }}" class="nav-item-hr active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Funcionários
            </a>
            <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
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
            <a class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
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
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Gestão de Funcionários</h2>
                <p class="text-muted small mb-0">Eureka Consulting - Painel de Recursos Humanos</p>
            </div>
            <button class="btn text-white px-4 fw-medium rounded-3" style="background-color: var(--accent);" data-bs-toggle="modal" data-bs-target="#modalCadastro">
                + Cadastrar Funcionário
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="card-custom p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Iniciais</th>
                            <th>Nome</th>
                            <th>Função / Cargo</th>
                            <th>Tipo</th>
                            <th>Início Contrato</th>
                            <th>Salário Bruto</th>
                            <th>Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($funcionarios as $f)
                            <tr>
                                <td><span class="badge p-2 fw-bold" style="background-color: #0d9488;">{{ $f->iniciais }}</span></td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $f->nome }}</div>
                                    <span class="text-muted small">{{ $f->email }}</span>
                                </td>
                                <td>{{ $f->cargo }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $f->tipo_trabalhador }}</span></td>
                                <td>{{ date('d/m/Y', strtotime($f->data_inicio_contrato)) }}</td>
                                <td class="fw-bold text-dark">{{ number_format($f->salario_bruto, 0, ',', '.') }} XOF</td>
                                <td>
                                    <span class="badge badge-{{ strtolower($f->estado) }} px-3 py-1.5 rounded-5 fw-medium">
                                        {{ $f->estado }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalVisualizar{{ $f->id }}" title="Consultar Detalhes">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#495057" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </button>
                                        <button class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $f->id }}" title="Editar Ficha">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Nenhum funcionário cadastrado até ao momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalCadastro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-light py-2 px-3">
                <h6 class="modal-title fw-bold m-0">Novo Cadastro de Funcionário</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('funcionarios.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    
                    <div class="modal-section-title">1. Informações Pessoais & Contactos</div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <label class="form-label-compact">Nome Completo *</label>
                            <input type="text" name="nome" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-compact">Email Institucional *</label>
                            <input type="email" name="email" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Contacto Telefónico</label>
                            <input type="text" name="contacto" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-compact">Data de Nascimento</label>
                            <input type="date" name="data_nascimento" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label-compact">Empresa</label>
                            <input type="text" name="empresa" value="Eureka Consulting" class="form-control form-control-compact">
                        </div>
                    </div>

                    <div class="modal-section-title">2. Identificação & Segurança Social</div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-3">
                            <label class="form-label-compact">Nº de B.I.</label>
                            <input type="text" name="bi" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">NIF *</label>
                            <input type="text" name="nif" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Nº Seg. Social (INSS)</label>
                            <input type="text" name="num_seguranca_social" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Data Inscrição INSS</label>
                            <input type="date" name="data_inscricao_inss" class="form-control form-control-compact">
                        </div>
                    </div>

                    <div class="modal-section-title">3. Regime de Trabalho & Datas</div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label-compact">Função / Cargo *</label>
                            <input type="text" name="cargo" class="form-control form-control-compact" placeholder="Ex: Contabilista" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label-compact">Iniciais *</label>
                            <input type="text" name="iniciais" class="form-control form-control-compact" placeholder="ABC" maxlength="3" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Tipo Trabalhador</label>
                            <select name="tipo_trabalhador" class="form-select form-control-compact">
                                <option value="Subordinado">Subordinado (Outrem)</option>
                                <option value="Liberal">Liberal (Própria)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Tipo Contrato</label>
                            <input type="text" name="tipo_contrato" value="Permanente" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-compact">Início do Contrato *</label>
                            <input type="date" name="data_inicio_contrato" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-compact">Fim periodo de experiencia</label>
                            <input type="date" name="data_fim_periodo_experiencia" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-compact">Fim do Contrato</label>
                            <input type="date" name="data_fim_contrato" class="form-control form-control-compact">
                        </div>
                    </div>

                    <div class="modal-section-title">4. Informações Financeiras</div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label-compact">Salário Bruto (XOF) *</label>
                            <input type="number" name="salario_bruto" class="form-control form-control-compact text-primary fw-bold" placeholder="0" min="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Banco</label>
                            <input type="text" name="banco" class="form-control form-control-compact" placeholder="Ex: BGFI, BAO">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Nº Conta Bancária</label>
                            <input type="text" name="num_conta_bancaria" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label-compact">Estado Inicial</label>
                            <select name="estado" class="form-select form-control-compact">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Suspenso">Suspenso</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light py-1 px-3">
                    <button type="button" class="btn btn-xs btn-secondary py-1 px-3 small shadow-sm" data-bs-dismiss="modal" style="font-size: 12px;">Cancelar</button>
                    <button type="submit" class="btn btn-xs btn-success py-1 px-3 small shadow-sm" style="font-size: 12px;">Gravar Funcionário</button>
                </div>
            </form>
        </div>
    </div>
</div>


@foreach($funcionarios as $f)
    
    <div class="modal fade" id="modalVisualizar{{ $f->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header bg-dark text-white py-2 px-3">
                    <h6 class="modal-title fw-bold m-0">Ficha Completa: {{ $f->nome }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3" style="font-size: 13px;">
                    <div class="row g-3">
                        <div class="col-6"><strong>Iniciais:</strong> <span class="badge bg-secondary">{{ $f->iniciais }}</span></div>
                        <div class="col-6"><strong>Estado:</strong> {{ $f->estado }}</div>
                        <hr class="my-1 text-muted">
                        <div class="col-12"><strong>Email:</strong> {{ $f->email }}</div>
                        <div class="col-6"><strong>Contacto:</strong> {{ $f->contacto ?? 'N/A' }}</div>
                        <div class="col-6"><strong>Nascimento:</strong> {{ $f->data_nascimento ? date('d/m/Y', strtotime($f->data_nascimento)) : 'N/A' }}</div>
                        <div class="col-12"><strong>Empresa:</strong> {{ $f->empresa }}</div>
                        <hr class="my-1 text-muted">
                        <div class="col-6"><strong>Nº B.I.:</strong> {{ $f->bi ?? 'N/A' }}</div>
                        <div class="col-6"><strong>NIF:</strong> {{ $f->nif }}</div>
                        <div class="col-6"><strong>Nº INSS:</strong> {{ $f->num_seguranca_social ?? 'N/A' }}</div>
                        <div class="col-6"><strong>Inscrição INSS:</strong> {{ $f->data_inscricao_inss ?? 'N/A' }}</div>
                        <hr class="my-1 text-muted">
                        <div class="col-6"><strong>Cargo/Função:</strong> {{ $f->cargo }}</div>
                        <div class="col-6"><strong>Tipo Trabalho:</strong> {{ $f->tipo_trabalhador }}</div>
                        <div class="col-6"><strong>Contrato:</strong> {{ $f->tipo_contrato }}</div>
                        <div class="col-6"><strong>Início Contrato:</strong> {{ date('d/m/Y', strtotime($f->data_inicio_contrato)) }}</div>
                        <div class="col-6"><strong>Fin periodo Exp</strong> {{ $f->data_fim_periodo_experiencia}}</div>
                        <div class="col-6"><strong>Fin de Contrato</strong> {{ $f->data_fim_contrato}}</div>
                        <hr class="my-1 text-muted">
                        <div class="col-12"><strong>Salário Bruto:</strong> <span class="text-primary fw-bold">{{ number_format($f->salario_bruto, 0, ',', '.') }} XOF</span></div>
                        <div class="col-6"><strong>Banco:</strong> {{ $f->banco ?? 'N/A' }}</div>
                        <div class="col-6"><strong>Conta Bancária:</strong> {{ $f->num_conta_bancaria ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar{{ $f->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header bg-primary text-white py-2 px-3">
                    <h6 class="modal-title fw-bold m-0">Editar Funcionário — {{ $f->nome }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('funcionarios.update', $f->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-3">
                        <div class="modal-section-title">1. Informações Pessoais & Contactos</div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-5">
                                <label class="form-label-compact">Nome Completo *</label>
                                <input type="text" name="nome" value="{{ $f->nome }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-compact">Email Institucional *</label>
                                <input type="email" name="email" value="{{ $f->email }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Contacto Telefónico</label>
                                <input type="text" name="contacto" value="{{ $f->contacto }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-compact">Data de Nascimento</label>
                                <input type="date" name="data_nascimento" value="{{ $f->data_nascimento }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label-compact">Empresa</label>
                                <input type="text" name="empresa" value="{{ $f->empresa }}" class="form-control form-control-compact">
                            </div>
                        </div>

                        <div class="modal-section-title">2. Identificação & Segurança Social</div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-3">
                                <label class="form-label-compact">Nº de B.I.</label>
                                <input type="text" name="bi" value="{{ $f->bi }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">NIF *</label>
                                <input type="text" name="nif" value="{{ $f->nif }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Nº Seg. Social (INSS)</label>
                                <input type="text" name="num_seguranca_social" value="{{ $f->num_seguranca_social }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Data Inscrição INSS</label>
                                <input type="date" name="data_inscricao_inss" value="{{ $f->data_inscricao_inss }}" class="form-control form-control-compact">
                            </div>
                        </div>

                        <div class="modal-section-title">3. Regime de Trabalho & Datas</div>
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <label class="form-label-compact">Função / Cargo *</label>
                                <input type="text" name="cargo" value="{{ $f->cargo }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-compact">Iniciais *</label>
                                <input type="text" name="iniciais" value="{{ $f->iniciais }}" class="form-control form-control-compact" maxlength="3" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Tipo Trabalhador</label>
                                <select name="tipo_trabalhador" class="form-select form-control-compact">
                                    <option value="Subordinado" {{ $f->tipo_trabalhador == 'Subordinado' ? 'selected' : '' }}>Subordinado (Outrem)</option>
                                    <option value="Liberal" {{ $f->tipo_trabalhador == 'Liberal' ? 'selected' : '' }}>Liberal (Própria)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Tipo Contrato</label>
                                <input type="text" name="tipo_contrato" value="{{ $f->tipo_contrato }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-compact">Início do Contrato *</label>
                                <input type="date" name="data_inicio_contrato" value="{{ $f->data_inicio_contrato }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-compact">Fim Exp.</label>
                                <input type="date" name="data_fim_periodo_experiencia" value="{{ $f->data_fim_periodo_experiencia }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-compact">Fim do Contrato</label>
                                <input type="date" name="data_fim_contrato" value="{{ $f->data_fim_contrato }}" class="form-control form-control-compact">
                            </div>
                        </div>

                        <div class="modal-section-title">4. Informações Financeiras</div>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label-compact">Salário Bruto (XOF) *</label>
                                <input type="number" name="salario_bruto" value="{{ $f->salario_bruto }}" class="form-control form-control-compact text-primary fw-bold" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Banco</label>
                                <input type="text" name="banco" value="{{ $f->banco }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Nº Conta Bancária</label>
                                <input type="text" name="num_conta_bancaria" value="{{ $f->num_conta_bancaria }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-compact">Estado</label>
                                <select name="estado" class="form-select form-control-compact">
                                    <option value="Activo" {{ $f->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ $f->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Suspenso" {{ $f->estado == 'Suspenso' ? 'selected' : '' }}>Suspenso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-1 px-3">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
