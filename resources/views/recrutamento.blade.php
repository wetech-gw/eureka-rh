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
            overflow: hidden; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent; }

        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }

        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }
        .table th { background-color: #f1f3f5; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        /* NOVO: Estilos para fixar a tabela e ativar o Scroll */
        .table-scrollable-container {
            max-height: 650px; /* Altere este valor para controlar a altura visível da tabela */
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

        .form-label-compact { font-size: 11px; font-weight: 600; color: #495057; margin-bottom: 2px; }
        .form-control-compact { padding: 4px 8px; font-size: 13px; border-radius: 6px; }

        .modern-search-group { position: relative; max-width: 380px; width: 100%; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; display: flex; align-items: center; }
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
            <a href="{{ route('dashboard') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</div>

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
                <h2 class="fw-bold m-0 text-dark">Gestão de Recrutamentos</h2>
                <p class="text-accent">Abertura de vagas e acompanhamento dos processos de seleção da empresa</p>
            </div>
            <div class="modern-search-group">
                <span class="modern-search-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </span>
                <input type="text" class="form-control modern-search-input" id="searchRecrutamento" placeholder="Pesquisar por vagas ou departamentos...">
            </div>
            <button type="button" class="btn text-white fw-medium btn-sm px-3 py-2 rounded-3" style="background-color: var(--accent);" data-bs-toggle="modal" data-bs-target="#modalNovaRecruta">
                <i class="fa-solid fa-plus me-1"></i> Nova Recruta
            </button>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Processos Ativos</span>
                    <h3 class="fw-bold my-1 text-dark">{{ $recrutamentos->where('status', 'Ativo')->count() }}</h3>
                    <span class="text-muted small">Vagas abertas a receber candidaturas</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Formações Disponíveis</span>
                    <h3 class="fw-bold my-1" style="color: var(--accent);">{{ $formacoes->count() }}</h3>
                    <span class="text-muted small">Programas de capacitação registados</span>
                </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-12">
                <div class="card-custom p-4 shadow-sm">
                    <div class="pb-2 mb-3 border-bottom">
                        <h6 class="fw-bold text-dark m-0">Vagas Ativas em Processo</h6>
                    </div>
                    <div class="table-scrollable-container">
                        <table class="table table-hover align-middle">
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
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <button type="button" class="btn btn-sm text-white fw-medium px-2 py-1" style="background-color: var(--accent); font-size: 11px;" data-bs-toggle="modal" data-bs-target="#modalCandidatar" data-vaga-id="{{ $vaga->id }}" data-vaga-titulo="{{ $vaga->titulo_vaga }}">
                                                        <i class="fa-solid fa-paper-plane me-1"></i> Candidatar
                                                    </button>
                                                    <form action="{{ route('recrutamento.alterarEstado', $vaga->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Expirado">
                                                        <button type="submit" class="btn btn-sm btn-outline-warning fw-medium px-2 py-1" onclick="return confirm('Tens a certeza que queres fechar esta vaga?')">
                                                            <i class="fa-solid fa-folder-minus me-1"></i> Fechar
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <form action="{{ route('recrutamento.alterarEstado', $vaga->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Ativo">
                                                    <button type="submit" class="btn btn-sm btn-outline-success fw-medium px-2 py-1">
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

<div class="modal fade" id="modalNovaRecruta" tabindex="-1" aria-labelledby="modalNovaRecrutaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content style border-0" style="border-radius: 12px;">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold m-0" id="modalNovaRecrutaLabel">Lançar Nova Recruta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('recrutamento.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 py-3">
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

                    <div class="mb-2">
                        <label class="form-label-compact">Requisitos Mínimos *</label>
                        <textarea name="requisitos" class="form-control form-control-compact" rows="3" placeholder="Formação acadêmica, ferramentas técnicas..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-3">
                    <button type="button" class="btn btn-light btn-sm px-3 py-2 rounded-3 fw-medium" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white fw-medium btn-sm px-3 py-2 rounded-3" style="background-color: var(--accent);">
                        Publicar Recruta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchRecrutamento');
        const tableRows = document.querySelectorAll('table tbody tr');

        searchInput.addEventListener('keyup', function (e) {
            const searchTerm = e.target.value.toLowerCase().trim();

            tableRows.forEach(row => {
                // Evita aplicar o filtro na linha de "Nenhum processo lançado" (se houver)
                if (row.cells.length === 1 && row.querySelector('td').getAttribute('colspan')) {
                    return;
                }

                // Captura o texto do título da vaga e do departamento
                const tituloVaga = row.cells[0]?.textContent ? row.cells[0].textContent.toLowerCase() : '';
                const departamento = row.cells[1]?.textContent ? row.cells[1].textContent.toLowerCase() : '';

                // Verifica se o termo pesquisado está incluído no título ou departamento
                if (tituloVaga.includes(searchTerm) || departamento.includes(searchTerm)) {
                    row.style.display = ''; // Mostra a linha
                } else {
                    row.style.display = 'none'; // Esconde a linha
                }
            });
        });
    });
</script>
</body>
</html>
</body>
</html>
