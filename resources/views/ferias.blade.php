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
            overflow: hidden; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent; }

        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }

        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
        .nav-item-hr svg { flex-shrink: 0; }
        .nav-item-hr:hover { background-color: #f1f3f5; color: #212529; text-decoration: none; }
        .nav-item-hr.active { background-color: #e6fdfa; color: var(--accent); font-weight: 600; text-decoration: none; }
        .text-accent { color: var(--accent); }

        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background: white; }

        /* Fixar Cabeçalho da Tabela e Ativar o Scroll */
        .table-scrollable-container {
            max-height: 650px; /* Altura limite para rolagem */
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
            <img src="{{ asset('eureka.jpeg') }}" alt="EUREKA Consulting" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 1rem;">
            <!--<span class="text-uppercase text-muted fw-bold d-block mt-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</span>-->
        </div>

        <nav class="flex-grow-1" style="overflow-y: auto; min-height: 0; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent;">
            <a href="{{ route('dashboard') }}" class="nav-item-hr">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                Dashboard
            </a>

            <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</div>

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
            <a href="{{ route('admin.contactos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.contactos*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"></path></svg>
                Contactos do Site
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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @include('partials.avisos-ferias')

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
                            <th>Valor Total</th>
                            <th>Valor Levantado</th>
                            <th>Saldo Restante</th>
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
                                    <span class="badge {{ $r->tipo == 'Férias anuais' ? 'bg-info text-dark' : 'bg-secondary' }}">
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
                                <td>
                                    @if($r->direito_subsidio_ferias)
                                        <span class="fw-bold">{{ number_format($r->valor_total_subsidio ?? 0, 0, ',', '.') }} XOF</span>
                                    @else
                                        <small class="text-muted">—</small>
                                    @endif
                                </td>
                                <td>
                                    @if($r->direito_subsidio_ferias)
                                        <span>{{ number_format($r->valor_subsidio_ferias ?? 0, 0, ',', '.') }} XOF</span>
                                        <small class="d-block text-muted">{{ $r->estado_pagamento_subsidio }}</small>
                                    @else
                                        <small class="text-muted">—</small>
                                    @endif
                                </td>
                                <td>
                                    @if($r->direito_subsidio_ferias)
                                        <span class="fw-bold text-success">{{ number_format($r->saldo_subsidio ?? 0, 0, ',', '.') }} XOF</span>
                                        <small class="d-block text-muted">Disponível para levantamento</small>
                                    @else
                                        <small class="text-muted">—</small>
                                    @endif
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
                                <td colspan="10" class="text-center text-muted py-4">Nenhum registo de ausência ou férias encontrado.</td>
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
            <form action="{{ route('ferias.store') }}" method="POST" data-subsidio-form>
                @csrf
                <div class="modal-body p-3">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label class="form-label-compact">Colaborador *</label>
                            <select name="funcionario_id" class="form-select form-control-compact" required>
                                <option value="">Selecione o Funcionário...</option>
                                @foreach($funcionarios as $func)
                                    <option value="{{ $func->id }}">
                                        {{ $func->nome }} ({{ $func->cargo }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-compact">Tipo de Registo *</label>
                            <select name="tipo" class="form-select form-control-compact" required>
                                <option value="Férias anuais">Férias anuais</option>
                                <option value="Licença de maternidade">Licença de maternidade</option>
                                <option value="Licença de paternidade">Licença de paternidade</option>
                                <option value="Licença por falecimento de familiar de 1.º grau">Licença por falecimento de familiar de 1.º grau</option>
                                <option value="Licença por falecimento de familiar de 2.º grau">Licença por falecimento de familiar de 2.º grau</option>
                                <option value="Licença por casamento civil">Licença por casamento civil</option>
                                <option value="Licença sem vencimento">Licença sem vencimento</option>
                                <option value="Outra licença">Outra licença</option>
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
                        <div class="col-md-3">
                            <label class="form-label-compact">Direito ao Subsídio</label>
                            <select name="direito_subsidio_ferias" class="form-select form-control-compact" data-direito-subsidio>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Valor Total do Subsídio</label>
                            <input type="number" min="0" step="0.01" name="valor_total_subsidio" class="form-control form-control-compact" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Valor a Levantar</label>
                            <input type="number" min="0" step="0.01" name="valor_subsidio_ferias" class="form-control form-control-compact" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-compact">Estado de Pagamento</label>
                            <select name="estado_pagamento_subsidio" class="form-select form-control-compact">
                                <option value="Não aplicável">Não aplicável</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Pago">Pago</option>
                            </select>
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
                    <!--<p><strong>Saldo de Férias Disponível:</strong> {{ $r->ferias_disponiveis_dias }} dia(s)</p>-->
                    <p><strong>Período:</strong> {{ date('d/m/Y', strtotime($r->data_inicio)) }} até {{ date('d/m/Y', strtotime($r->data_fim)) }}</p>
                    <p><strong>Total de Dias:</strong> {{ $r->dias }} dia(s)</p>
                    <p><strong>Estado do Pedido:</strong> {{ $r->estado_pedido }}</p>
                    @if($r->direito_subsidio_ferias)
                        <p><strong>Valor Total do Subsídio:</strong> {{ number_format($r->valor_total_subsidio ?? 0, 0, ',', '.') }} XOF</p>
                        <p><strong>Valor Levantado:</strong> {{ number_format($r->valor_subsidio_ferias ?? 0, 0, ',', '.') }} XOF</p>
                        <p><strong>Saldo do Subsídio:</strong> {{ number_format($r->saldo_subsidio ?? 0, 0, ',', '.') }} XOF</p>
                        <p><strong>Estado do Pagamento:</strong> {{ $r->estado_pagamento_subsidio }}</p>
                    @endif
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
                @php
                    $valorTotalSubsidioEdicao = (float) ($r->valor_total_subsidio ?? 0);
                @endphp
                <form action="{{ route('ferias.update', $r->id) }}" method="POST" data-subsidio-form>
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label-compact">Tipo</label>
                                <select name="tipo" class="form-select form-control-compact">
                                    <option value="Férias anuais" {{ $r->tipo == 'Férias anuais' ? 'selected' : '' }}>Férias anuais</option>
                                    <option value="Licença de maternidade" {{ $r->tipo == 'Licença de maternidade' ? 'selected' : '' }}>Licença de maternidade</option>
                                    <option value="Licença de paternidade" {{ $r->tipo == 'Licença de paternidade' ? 'selected' : '' }}>Licença de paternidade</option>
                                    <option value="Licença por falecimento de familiar de 1.º grau" {{ $r->tipo == 'Licença por falecimento de familiar de 1.º grau' ? 'selected' : '' }}>Licença por falecimento de familiar de 1.º grau</option>
                                    <option value="Licença por falecimento de familiar de 2.º grau" {{ $r->tipo == 'Licença por falecimento de familiar de 2.º grau' ? 'selected' : '' }}>Licença por falecimento de familiar de 2.º grau</option>
                                    <option value="Licença por casamento civil" {{ $r->tipo == 'Licença por casamento civil' ? 'selected' : '' }}>Licença por casamento civil</option>
                                    <option value="Licença sem vencimento" {{ $r->tipo == 'Licença sem vencimento' ? 'selected' : '' }}>Licença sem vencimento</option>
                                    <option value="Outra licença" {{ $r->tipo == 'Outra licença' ? 'selected' : '' }}>Outra licença</option>
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
                            <div class="col-md-3">
                                <label class="form-label-compact">Direito ao Subsídio</label>
                                <select name="direito_subsidio_ferias" class="form-select form-control-compact" data-direito-subsidio>
                                    <option value="0" {{ !$r->direito_subsidio_ferias ? 'selected' : '' }}>Não</option>
                                    <option value="1" {{ $r->direito_subsidio_ferias ? 'selected' : '' }}>Sim</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Valor Total do Subsídio</label>
                                <input type="number" min="0" step="0.01" name="valor_total_subsidio" value="{{ $valorTotalSubsidioEdicao }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Valor a Levantar</label>
                                <input type="number" name="valor_subsidio_ferias" min="0" step="0.01" value="{{ $r->valor_subsidio_ferias ?? 0 }}" class="form-control form-control-compact">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-compact">Estado de Pagamento</label>
                                <select name="estado_pagamento_subsidio" class="form-select form-control-compact">
                                    <option value="Não aplicável" {{ ($r->estado_pagamento_subsidio ?? 'Não aplicável') == 'Não aplicável' ? 'selected' : '' }}>Não aplicável</option>
                                    <option value="Pendente" {{ ($r->estado_pagamento_subsidio ?? '') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="Pago" {{ ($r->estado_pagamento_subsidio ?? '') == 'Pago' ? 'selected' : '' }}>Pago</option>
                                </select>
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
    const formulariosSubsidio = document.querySelectorAll('[data-subsidio-form]');
    const tipoFeriasAnuais = 'Férias anuais';
    const estadoAprovado = 'Aprovado';

    function sincronizarDireitoSubsidio(form) {
        const tipoSelect = form.querySelector('[name="tipo"]');
        const estadoPedidoSelect = form.querySelector('[name="estado_pedido"]');
        const direitoSelect = form.querySelector('[data-direito-subsidio]');
        const aplicaSubsidio = tipoSelect?.value === tipoFeriasAnuais && estadoPedidoSelect?.value === estadoAprovado;

        if (direitoSelect) {
            direitoSelect.value = aplicaSubsidio ? '1' : '0';
        }
    }

    formulariosSubsidio.forEach(form => {
        ['tipo', 'estado_pedido'].forEach(nomeCampo => {
            const campo = form.querySelector(`[name="${nomeCampo}"]`);
            if (campo) {
                campo.addEventListener('change', () => sincronizarDireitoSubsidio(form));
            }
        });

        sincronizarDireitoSubsidio(form);
    });

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
