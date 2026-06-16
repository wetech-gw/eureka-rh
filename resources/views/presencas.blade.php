<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Controlo de Presenças</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        
        /* ALTERAÇÃO AQUI: Menu Lateral Fixo */
        .sidebar { 
            width: 220px; 
            height: 100vh;          /* Ocupa exatamente a altura do ecrã */
            position: sticky;       /* Faz o menu colar no topo */
            top: 0;                 /* Alinha no topo do ecrã */
            background: white; 
            flex-shrink: 0; 
            overflow-y: auto;       /* Permite scroll dentro do menu se houver muitos itens */
        }
        
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        
        /* Cores dos Badges de Presença */
        .badge-presente { background-color: #d1e7dd; color: #0f5132; }
        .badge-atraso { background-color: #fff3cd; color: #664d03; }
        .badge-falta { background-color: #f8d7da; color: #842029; }
        
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
            <a href="{{ route('presencas.index') }}" class="nav-item-hr active">
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
            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr">
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
                <h2 class="fw-bold m-0 text-dark">Controlo de Presenças</h2>
                <p class="text-muted small mb-0">Registo diário de assiduidade, atrasos e faltas dos colaboradores</p>
            </div>
            <button class="btn text-white px-4 fw-medium rounded-3" style="background-color: var(--accent);" data-bs-toggle="modal" data-bs-target="#modalRegistar">
                + Registar Presença
            </button>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Presenças Hoje</span>
                    <h3 class="fw-bold my-1 text-success">{{ $presencasHoje }}</h3>
                    <span class="text-muted small">Colaboradores ativos hoje</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Faltas (Este Mês)</span>
                    <h3 class="fw-bold my-1 text-danger">{{ $faltasEsteMes }}</h3>
                    <span class="text-muted small">Total de ausências registadas</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Taxa de Assiduidade</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $taxaAssiduidade }} <span class="fs-6 text-muted">%</span></h3>
                    <span class="text-muted small">Média global de assiduidade</span>
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
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Funcionário</th>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presencas as $p)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $p->nome }}</div>
                                    <span class="text-muted small">{{ $p->cargo }}</span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($p->data)) }}</td>
                                <td>
                                    <span class="fw-medium text-secondary">
                                        {{ $p->hora_entrada ? date('H:i', strtotime($p->hora_entrada)) : '—' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-medium text-secondary">
                                        {{ $p->hora_saida ? date('H:i', strtotime($p->hora_saida)) : '—' }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->estado == 'Presente')
                                        <span class="badge badge-presente px-3 py-1.5 rounded-5 fw-medium">Presente</span>
                                    @elseif($p->estado == 'Atraso')
                                        <span class="badge badge-atraso px-3 py-1.5 rounded-5 fw-medium">Atraso</span>
                                    @else
                                        <span class="badge badge-falta px-3 py-1.5 rounded-5 fw-medium">{{ $p->estado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalVer{{ $p->id }}">
                                            Exibir
                                        </button>
                                        <button class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $p->id }}">
                                            Editar / Justificar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Nenhum registo de presença encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalRegistar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-light py-2 px-3">
                <h6 class="modal-title fw-bold m-0">Registar Presença / Ponto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('presencas.store') }}" method="POST">
                @csrf
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label class="form-label-compact">Colaborador *</label>
                            <select name="funcionario_id" class="form-select form-control-compact" required>
                                <option value="">Selecione...</option>
                                @foreach($funcionarios as $func)
                                    <option value="{{ $func->id }}">{{ $func->nome }} ({{ $func->cargo }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-compact">Data *</label>
                            <input type="date" name="data" value="{{ date('Y-m-d') }}" class="form-control form-control-compact" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Hora de Entrada</label>
                            <input type="time" name="hora_entrada" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Hora de Saída</label>
                            <input type="time" name="hora_saida" class="form-control form-control-compact">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-compact">Estado *</label>
                            <select name="estado" class="form-select form-control-compact" required>
                                <option value="Presente">Presente</option>
                                <option value="Atraso">Atraso</option>
                                <option value="Falta Justificada">Falta Justificada</option>
                                <option value="Falta Injustificada">Falta Injustificada</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label-compact">Observações / Notas</label>
                            <textarea name="observacoes" rows="2" class="form-control form-control-compact" placeholder="Ex: Esqueceu-se de picar o ponto, atestado médico, etc..."></textarea>
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

@foreach($presencas as $p)
    <div class="modal fade" id="modalVer{{ $p->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header bg-dark text-white py-2 px-3">
                    <h6 class="modal-title fw-bold m-0">Registo de: {{ $p->nome }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3" style="font-size: 13px;">
                    <p><strong>Cargo:</strong> {{ $p->cargo }}</p>
                    <p><strong>Data:</strong> {{ date('d/m/Y', strtotime($p->data)) }}</p>
                    <p><strong>Hora de Entrada:</strong> {{ $p->hora_entrada ? date('H:i', strtotime($p->hora_entrada)) : '—' }}</p>
                    <p><strong>Hora de Saída:</strong> {{ $p->hora_saida ? date('H:i', strtotime($p->hora_saida)) : '—' }}</p>
                    <p><strong>Estado:</strong> {{ $p->estado }}</p>
                    <hr>
                    <p><strong>Observações / Justificações:</strong></p>
                    <p class="bg-light p-2 rounded text-muted italic">{{ $p->observacoes ?? 'Nenhuma observação registada.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar{{ $p->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header bg-primary text-white py-2 px-3">
                    <h6 class="modal-title fw-bold m-0">Editar Presença - {{ $p->nome }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('presencas.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label-compact">Data</label>
                                <input type="date" name="data" value="{{ $p->data }}" class="form-control form-control-compact" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-compact">Hora de Entrada</label>
                                <input type="time" name="hora_entrada" value="{{ $p->hora_entrada }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-compact">Hora de Saída</label>
                                <input type="time" name="hora_saida" value="{{ $p->hora_saida }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-compact">Estado</label>
                                <select name="estado" class="form-select form-control-compact">
                                    <option value="Presente" {{ $p->estado == 'Presente' ? 'selected' : '' }}>Presente</option>
                                    <option value="Atraso" {{ $p->estado == 'Atraso' ? 'selected' : '' }}>Atraso</option>
                                    <option value="Falta Justificada" {{ $p->estado == 'Falta Justificada' ? 'selected' : '' }}>Falta Justificada</option>
                                    <option value="Falta Injustificada" {{ $p->estado == 'Falta Injustificada' ? 'selected' : '' }}>Falta Injustificada</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-compact">Observações / Justificação</label>
                                <textarea name="observacoes" rows="3" class="form-control form-control-compact" placeholder="Motivo do atraso ou falta...">{{ $p->observacoes ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-1">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn_ btn-primary btn-sm">Atualizar Registo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>