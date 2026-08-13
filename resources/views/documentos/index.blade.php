<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Documentos</title>
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
            overflow: hidden; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent; }

        .main-content { flex-grow: 1; padding: 1.5rem; background-color: #f8f9fa; overflow-y: auto; }

        .nav-item-hr { display: flex; align-items: center; gap: 8px; padding: 7px 10px; color: #495057; text-decoration: none; border-radius: 8px; margin-bottom: 2px; font-size: 13px; transition: all 0.2s; cursor: pointer; }
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
    </style>
</head>
<body>

    <div class="wrapper">

        <!-- SIDEBAR ORIGINAL EUREKA -->
        <aside class="sidebar border-end p-3 d-flex flex-column" style="min-height: 100vh;">
            <div class="mb-4">
                <img src="{{ asset('eureka.jpeg') }}" alt="EUREKA Consulting" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 1rem;">
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

            <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Férias & Licenças
            </a>

            <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Avaliações
            </a>

            <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes.index') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Formações
            </a>

            <a href="{{ route('presencas.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
                Presenças
            </a>

            <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('folhas.index') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                    <path d="M7 6h4"></path>
                    <path d="M7 9h4"></path>
                    <path d="M7 12h2"></path>
                </svg>
                Folha-Salarial
            </a>

            <a href="{{ route('recrutamento.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento.index') ? 'active' : '' }}" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                    <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
                </svg>
                Recrutamentos
            </a>

            <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2" style="text-decoration: none;">
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

            <a href="{{ route('usuarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
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

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0 text-dark">Arquivo de Documentos</h2>
                <p class="text-accent">Gestão documental por categoria, tipo e número de referência</p>
            </div>
            <button type="button" class="btn text-white fw-medium shadow-sm px-3" style="background-color: #0d9488; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#createDocumentoModal">
                <i class="fa-solid fa-file-circle-plus me-1"></i> Registar Documento
            </button>
        </div>

        <form method="GET" action="{{ route('documentos.index') }}" class="card-custom p-3 mb-3">
            <div class="row g-2">
                <div class="col-md-5"><input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Pesquisar por nome, n.º referência, categoria ou departamento"></div>
                <div class="col-md-3">
                    <select name="categoria" class="form-select form-select-sm">
                        <option value="">Categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-grid"><button class="btn btn-sm btn-outline-secondary">Filtrar</button></div>
            </div>
        </form>

        <!-- INDICADORES (CARDS PEQUENOS) -->
        <div class="row g-2 mb-4 row-cols-1 row-cols-md-3">
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #495057;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Total Movimentado</span>
                        <h4 class="fw-bold m-0 text-dark">{{ $totalDocumentos }}</h4>
                    </div>
                    <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-folder-open" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #10b981;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Entradas</span>
                        <h4 class="fw-bold m-0 text-success">{{ $totalEntradas }}</h4>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-arrow-down" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #ef4444;">
                    <div class="lh-sm">
                        <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Saídas</span>
                        <h4 class="fw-bold m-0 text-danger">{{ $totalSaidas }}</h4>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fa-solid fa-arrow-up" style="font-size: 13px;"></i>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="small fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- TABELA DE REGISTOS -->
        <div class="card-custom p-4 shadow-sm">
            <div class="pb-2 mb-3 border-bottom">
                <h6 class="fw-bold text-dark m-0">Histórico de Movimentação de Arquivos</h6>
            </div>

            <div class="table-scrollable-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>N.º Referência</th>
                            <th>Nome do Documento</th>
                            <th>Categoria</th>
                            <th>Tipo de Operação</th>
                            <th>Data de Operação</th>
                            <th>Departamento Relacionado</th>
                            <th class="text-center">Arquivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documentos as $doc)
                            <tr>
                                <td class="fw-bold text-dark">{{ $doc->numero_referencia ?? '—' }}</td>
                                <td>{{ $doc->nome }}</td>
                                <td>{{ $doc->categoria }}</td>
                                <td>{{ $doc->tipo }}</td>
                                <td class="small text-muted">{{ date('d/m/Y', strtotime($doc->data_operacao)) }}</td>
                                <td class="fw-semibold text-secondary">{{ $doc->departamento }}</td>
                                <td class="text-center">
                                    @if($doc->arquivo_pdf)
                                        <a href="{{ route('storage.file', ['path' => $doc->arquivo_pdf]) }}" target="_blank" class="btn btn-sm btn-light border text-dark fw-medium">
                                            <i class="fa-solid fa-file-pdf text-danger me-1"></i> Abrir PDF
                                        </a>
                                    @else
                                        <span class="text-muted small">Sem ficheiro</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4 small">Nenhum registo documental encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- MODAL BOOTSTRAP ORIGINAL PARA REGISTO -->
<div class="modal fade" id="createDocumentoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold">Novo Registo de Documentação</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nome do Documento / Título</label>
                        <input type="text" name="nome" class="form-control border-secondary-subtle" placeholder="Ex: Termo de Entrega de Portátil" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Número de Referência</label>
                        <input type="text" name="numero_referencia" class="form-control border-secondary-subtle" placeholder="Ex: 65/2026" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Categoria</label>
                        <input type="text" name="categoria" class="form-control border-secondary-subtle" placeholder="Ex: Contrato, Política Interna, Declaração" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Tipo de Operação</label>
                        <select name="tipo" class="form-select border-secondary-subtle" required>
                            <option value="Entrada">Entrada (Recebido)</option>
                            <option value="Saída">Saída (Enviado)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Data de Operação</label>
                        <input type="date" name="data_operacao" value="{{ date('Y-m-d') }}" class="form-control border-secondary-subtle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Departamento Relacionado</label>
                        <input type="text" name="departamento" class="form-control border-secondary-subtle" placeholder="Ex: Contabilidade, Administração" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Ficheiro (Apenas PDF)</label>
                        <input type="file" name="arquivo_pdf" class="form-control border-secondary-subtle" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #0d9488;">Salvar Registo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
