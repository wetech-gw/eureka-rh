<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Estagiários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }
        .sidebar { width: 220px; height: 100vh; position: sticky; top: 0; background: white; flex-shrink: 0; overflow: hidden; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent; }
        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }
        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .text-accent { color: var(--accent); }
    </style>
</head>
<body>
<div class="wrapper">
    <aside class="sidebar border-end p-3 d-flex flex-column">
        <div class="mb-4">
            <img src="{{ asset('eureka.jpeg') }}" alt="EUREKA Consulting" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 1rem;">
            <!--<span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>-->
        </div>

        <nav class="flex-grow-1" style="overflow-y: auto; min-height: 0; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent;">
            <a href="{{ route('dashboard') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</div>

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
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
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
            <a href="{{ route('documentos.colaboradores.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('documentos.colaboradores.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
                Dossiê do Colaborador
            </a>
            <a href="{{ route('estagiarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('estagiarios.index') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                </svg>
                Gestão de Estagiários
            </a>
            {{-- <a class="nav-item-hr p-2.5 rounded-3 mb-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                Relatórios
            </a> --}}
            <a href="{{ route('usuarios.index') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Utilizadores / Acessos
            </a>
            @if(Auth::user()->role === 'Responsável')
            <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Site Público</div>

            <a href="{{ route('admin.inicio.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.inicio*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11 12 4l9 7v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"></path><path d="M9 22V12h6v10"></path></svg>
                Início (Hero)
            </a>

                <a href="{{ route('admin.estatisticas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.estatisticas*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    Estatísticas (Hero)
                </a>

                <a href="{{ route('admin.boost.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.boost*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 15c-1.5 1.5-2 5-2 5s3.5-.5 5-2"/><path d="M9 15s5-1 8-4 4-8 4-8-5 1-8 4-4 8-4 8Z"/><circle cx="14.5" cy="9.5" r="1.5"/></svg>
                    BOOST_ME
                </a>

            <a href="{{ route('admin.servicos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.servicos*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"></path></svg>
                Serviços
            </a>

            <a href="{{ route('admin.recursos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.recursos*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                Recursos
            </a>

            <a href="{{ route('admin.sobre.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.sobre*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"></path></svg>
                Sobre
            </a>

            <a href="{{ route('admin.noticias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.noticias*') ? 'active' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8M15 18h-5M10 6h8v4h-8V6Z"></path></svg>
                Notícias
            </a>
        @endif
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
                <h2 class="fw-bold m-0 text-dark">Gestão de Estagiários</h2>
                <p class="text-accent mb-0">Acompanhamento académico, plano de atividades e certificação</p>
            </div>
            <button class="btn text-white" style="background-color: var(--accent);" data-bs-toggle="modal" data-bs-target="#modalEstagiario">+ Registar Estagiário</button>
        </div>

        <form method="GET" action="{{ route('estagiarios.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Pesquisar por nome, instituição, curso, supervisor ou departamento">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Filtrar</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-2 mb-3">
            <div class="col-md-4"><div class="card-custom p-3"><small>Total</small><h4 class="m-0">{{ $totalEstagiarios }}</h4></div></div>
            <div class="col-md-4"><div class="card-custom p-3"><small>Ativos</small><h4 class="m-0 text-success">{{ $ativos }}</h4></div></div>
            <div class="col-md-4"><div class="card-custom p-3"><small>Concluídos</small><h4 class="m-0 text-primary">{{ $concluidos }}</h4></div></div>
        </div>

        <div class="card-custom p-3">
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Instituição / Curso</th>
                            <th>Supervisor</th>
                            <th>Departamento</th>
                            <th>Período</th>
                            <th>Status</th>
                            <th>Avaliação</th>
                            <th>Certificado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estagiarios as $e)
                            <tr>
                                <td>
                                    <strong>{{ $e->nome }}</strong><br>
                                    <small class="text-muted">{{ $e->email ?? '-' }} / {{ $e->telefone ?? '-' }}</small>
                                </td>
                                <td>{{ $e->instituicao_ensino }}<br><small class="text-muted">{{ $e->curso }}</small></td>
                                <td>{{ $e->supervisor_responsavel }}</td>
                                <td>{{ $e->departamento }}</td>
                                <td>{{ date('d/m/Y', strtotime($e->data_inicio)) }} - {{ date('d/m/Y', strtotime($e->data_fim)) }}</td>
                                <td>{{ $e->status }}</td>
                                <td>
                                    @php
                                        $notaTabela = null;
                                        if (!empty($e->avaliacao_desempenho) && preg_match('/Pontuação:\s*(\d)\/5/i', $e->avaliacao_desempenho, $m)) {
                                            $notaTabela = (int) $m[1];
                                        }
                                    @endphp
                                    @if($notaTabela)
                                        <div style="letter-spacing: 1px; line-height: 1;" class="mb-1">
                                            @for($i=1;$i<=5;$i++)
                                                <span style="color: {{ $i <= $notaTabela ? '#f59e0b' : '#d1d5db' }}; font-size: 14px;">★</span>
                                            @endfor
                                        </div>
                                        <small class="text-muted">{{ $e->avaliacao_desempenho }}</small>
                                    @else
                                        <small>{{ $e->avaliacao_desempenho ?? '-' }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($e->arquivo_certificado)
                                        <a href="{{ route('storage.file', ['path' => $e->arquivo_certificado]) }}" class="btn btn-sm btn-light border" target="_blank">Download</a>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalDetalhes{{ $e->id }}">Detalhes</button>
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $e->id }}">Editar</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">Nenhum estagiário registado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalEstagiario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--accent); color: #fff;">
                <h6 class="modal-title">Novo Estagiário</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('estagiarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6"><label class="form-label">Nome *</label><input class="form-control" name="nome" required></div>
                        <div class="col-md-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email"></div>
                        <div class="col-md-3"><label class="form-label">Telefone</label><input class="form-control" name="telefone"></div>
                        <div class="col-md-6"><label class="form-label">Instituição *</label><input class="form-control" name="instituicao_ensino" required></div>
                        <div class="col-md-6"><label class="form-label">Curso *</label><input class="form-control" name="curso" required></div>
                        <div class="col-md-6"><label class="form-label">Supervisor *</label><input class="form-control" name="supervisor_responsavel" required></div>
                        <div class="col-md-6"><label class="form-label">Departamento *</label><input class="form-control" name="departamento" required></div>
                        <div class="col-md-3"><label class="form-label">Data Início *</label><input type="date" class="form-control" name="data_inicio" required></div>
                        <div class="col-md-3"><label class="form-label">Data Fim *</label><input type="date" class="form-control" name="data_fim" required></div>
                        <div class="col-md-3"><label class="form-label">Status *</label>
                            <select class="form-select" name="status" required>
                                <option value="Ativo">Ativo</option>
                                <option value="Concluído">Concluído</option>
                                <option value="Suspenso">Suspenso</option>
                            </select>
                        </div>
                        <div class="col-md-3"><label class="form-label">Certificado (PDF)</label><input type="file" class="form-control" name="arquivo_certificado" accept=".pdf"></div>
                        <div class="col-md-6"><label class="form-label">Plano de atividades</label><textarea class="form-control" name="plano_atividades" rows="2"></textarea></div>
                        <div class="col-md-3">
                            <label class="form-label">Pontuação (1 a 5 estrelas)</label>
                            <select class="form-select" name="pontuacao_estrelas">
                                <option value="">Selecione uma nota...</option>
                                <option value="1">★ 1.0 (Muito Insuficiente)</option>
                                <option value="2">★ 2.0 (Insuficiente)</option>
                                <option value="3">★ 3.0 (Regular / Alinhado)</option>
                                <option value="4">★ 4.0 (Bom / Acima da Média)</option>
                                <option value="5">★ 5.0 (Excelente / Excecional)</option>
                            </select>
                        </div>
                        <div class="col-md-3"><label class="form-label">Comentário de avaliação</label><textarea class="form-control" name="avaliacao_desempenho" rows="2"></textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white" style="background-color: var(--accent);">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($estagiarios as $e)
<div class="modal fade" id="modalDetalhes{{ $e->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--accent); color:#fff;">
                <h6 class="modal-title">Detalhes do Estagiário</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col-md-6"><strong>Nome:</strong> {{ $e->nome }}</div>
                    <div class="col-md-6"><strong>Status:</strong> {{ $e->status }}</div>
                    <div class="col-md-6"><strong>Email:</strong> {{ $e->email ?? '-' }}</div>
                    <div class="col-md-6"><strong>Telefone:</strong> {{ $e->telefone ?? '-' }}</div>
                    <div class="col-md-6"><strong>Instituição:</strong> {{ $e->instituicao_ensino }}</div>
                    <div class="col-md-6"><strong>Curso:</strong> {{ $e->curso }}</div>
                    <div class="col-md-6"><strong>Supervisor:</strong> {{ $e->supervisor_responsavel }}</div>
                    <div class="col-md-6"><strong>Departamento:</strong> {{ $e->departamento }}</div>
                    <div class="col-md-6"><strong>Início:</strong> {{ date('d/m/Y', strtotime($e->data_inicio)) }}</div>
                    <div class="col-md-6"><strong>Fim:</strong> {{ date('d/m/Y', strtotime($e->data_fim)) }}</div>
                    <div class="col-md-12"><strong>Plano:</strong> {{ $e->plano_atividades ?? '-' }}</div>
                    <div class="col-md-12"><strong>Avaliação:</strong> {{ $e->avaliacao_desempenho ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditar{{ $e->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--accent); color:#fff;">
                <h6 class="modal-title">Editar Estagiário</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('estagiarios.update', $e->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6"><label class="form-label">Nome *</label><input class="form-control" name="nome" value="{{ $e->nome }}" required></div>
                        <div class="col-md-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="{{ $e->email }}"></div>
                        <div class="col-md-3"><label class="form-label">Telefone</label><input class="form-control" name="telefone" value="{{ $e->telefone }}"></div>
                        <div class="col-md-6"><label class="form-label">Instituição *</label><input class="form-control" name="instituicao_ensino" value="{{ $e->instituicao_ensino }}" required></div>
                        <div class="col-md-6"><label class="form-label">Curso *</label><input class="form-control" name="curso" value="{{ $e->curso }}" required></div>
                        <div class="col-md-6"><label class="form-label">Supervisor *</label><input class="form-control" name="supervisor_responsavel" value="{{ $e->supervisor_responsavel }}" required></div>
                        <div class="col-md-6"><label class="form-label">Departamento *</label><input class="form-control" name="departamento" value="{{ $e->departamento }}" required></div>
                        <div class="col-md-3"><label class="form-label">Data Início *</label><input type="date" class="form-control" name="data_inicio" value="{{ $e->data_inicio }}" required></div>
                        <div class="col-md-3"><label class="form-label">Data Fim *</label><input type="date" class="form-control" name="data_fim" value="{{ $e->data_fim }}" required></div>
                        <div class="col-md-3"><label class="form-label">Status *</label>
                            <select class="form-select" name="status" required>
                                <option value="Ativo" {{ $e->status == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Concluído" {{ $e->status == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                                <option value="Suspenso" {{ $e->status == 'Suspenso' ? 'selected' : '' }}>Suspenso</option>
                            </select>
                        </div>
                        <div class="col-md-3"><label class="form-label">Certificado (PDF)</label><input type="file" class="form-control" name="arquivo_certificado" accept=".pdf"></div>
                        <div class="col-md-6"><label class="form-label">Plano de atividades</label><textarea class="form-control" name="plano_atividades" rows="2">{{ $e->plano_atividades }}</textarea></div>
                        <div class="col-md-3">
                            <label class="form-label">Pontuação (1 a 5 estrelas)</label>
                            @php
                                $notaAtual = null;
                                if (!empty($e->avaliacao_desempenho) && preg_match('/Pontuação:\s*(\d)\/5/i', $e->avaliacao_desempenho, $m)) {
                                    $notaAtual = (int) $m[1];
                                }
                            @endphp
                            <select class="form-select" name="pontuacao_estrelas">
                                <option value="">Selecione uma nota...</option>
                                <option value="1" {{ $notaAtual === 1 ? 'selected' : '' }}>★ 1.0 (Muito Insuficiente)</option>
                                <option value="2" {{ $notaAtual === 2 ? 'selected' : '' }}>★ 2.0 (Insuficiente)</option>
                                <option value="3" {{ $notaAtual === 3 ? 'selected' : '' }}>★ 3.0 (Regular / Alinhado)</option>
                                <option value="4" {{ $notaAtual === 4 ? 'selected' : '' }}>★ 4.0 (Bom / Acima da Média)</option>
                                <option value="5" {{ $notaAtual === 5 ? 'selected' : '' }}>★ 5.0 (Excelente / Excecional)</option>
                            </select>
                        </div>
                        <div class="col-md-3"><label class="form-label">Comentário de avaliação</label><textarea class="form-control" name="avaliacao_desempenho" rows="2">{{ $e->avaliacao_desempenho }}</textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white" style="background-color: var(--accent);">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
