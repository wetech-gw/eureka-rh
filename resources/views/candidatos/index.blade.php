<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Candidatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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
        .modern-search-group { position: relative; max-width: 380px; width: 100%; }
        .modern-search-input { padding: 9px 16px 9px 40px; font-size: 13px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; transition: all 0.2s ease-in-out; }
        .modern-search-input:focus { background-color: #ffffff; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15); outline: none; }
        .modern-search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; display: flex; align-items: center; }
    </style>
@include('partials.theme-head')
</head>
<body>

<div class="wrapper">

    <aside class="sidebar border-end p-3 d-flex flex-column">
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

            <a href="{{ route('candidatos.index') }}" class="nav-item-hr active p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Candidatos
            </a>
            <a href="{{ route('candidaturas-espontaneas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('candidaturas-espontaneas*') ? 'active' : '' }}" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="12" y2="18"></line>
                    <line x1="15" y1="15" x2="12" y2="18"></line>
                </svg>
                CV Espontâneos
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
            @if(in_array(Auth::user()->role, ['Responsável', 'CEO']))
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
        @include('partials.theme-toggle')
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
                <h2 class="fw-bold m-0 text-dark">Banco de Candidatos</h2>
                <p class="text-accent">Triagem de currículos e controlo de candidaturas submetidas por vaga</p>
            </div>
            <div class="modern-search-group">
                <span class="modern-search-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </span>
                <input type="text" class="form-control modern-search-input" id="searchCandidato" placeholder="Pesquisar por nome, profissão, competências, localização...">
            </div>
            <button type="button" onclick="exportarCandidatosPDF()" class="btn btn-light border btn-sm fw-semibold rounded-3 d-inline-flex align-items-center gap-2 shadow-sm text-dark px-3" style="height: 38px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="12" y2="18"></line>
                        <line x1="15" y1="15" x2="12" y2="18"></line>
                    </svg>
                    Exportar PDF
                </button>

            <button type="button" class="btn text-white fw-medium shadow-sm px-3" style="background-color: #0d9488; font-size: 14px; border: none; height: 38px;" data-bs-toggle="modal" data-bs-target="#createCandidatoModal">
                <i class="fa-solid fa-user-plus me-1"></i> Adicionar Candidato
            </button>
        </div>

    <div class="row g-2 mb-4 row-cols-2 row-cols-md-4 row-cols-lg-5">
    <!-- Card: Total de Candidatos -->
    <div class="col">
        <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #495057;">
            <div class="lh-sm">
                <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Total</span>
                <h4 class="fw-bold m-0 text-dark">{{ $totalCandidatos }}</h4>
            </div>
            <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-users" style="font-size: 13px;"></i>
            </div>
        </div>
    </div>

    <!-- Card: Triagens Pendentes -->
    <div class="col">
        <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #f59e0b;">
            <div class="lh-sm">
                <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Pendentes</span>
                <h4 class="fw-bold m-0 text-warning">{{ $totalPendentes }}</h4>
            </div>
            <div class="bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-clock" style="font-size: 13px;"></i>
            </div>
        </div>
    </div>
    <!-- Card: Aceitos -->
    <div class="col">
        <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #10b981;">
            <div class="lh-sm">
                <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Aceitos</span>
                <h4 class="fw-bold m-0 text-success">{{ $candidaturas->where('status', 'Aceito')->count() }}</h4>
            </div>
            <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-check" style="font-size: 13px;"></i>
            </div>
        </div>
    </div>
        <!-- Card: Lista de Espera -->
    <div class="col">
        <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #6b21a8;">
            <div class="lh-sm">
                <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Em Espera</span>
                <h4 class="fw-bold m-0" style="color: #6b21a8;">{{ $candidaturas->where('status', 'Lista de Espera')->count() }}</h4>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background-color: #f3e8ff; color: #6b21a8;">
                <i class="fa-solid fa-pause" style="font-size: 13px;"></i>
            </div>
        </div>
    </div>
    <!-- Card: Rejeitados -->
    <div class="col">
        <div class="card-custom p-2 shadow-sm d-flex align-items-center justify-content-between" style="border-left: 4px solid #ef4444;">
            <div class="lh-sm">
                <span class="text-muted fw-bold text-uppercase" style="font-size: 11px;">Rejeitados</span>
                <h4 class="fw-bold m-0 text-danger">{{ $candidaturas->where('status', 'Rejeitado')->count() }}</h4>
            </div>
            <div class="bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-xmark" style="font-size: 13px;"></i>
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

        <form method="GET" action="{{ route('candidatos.index') }}" class="card-custom p-3 mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="profissao" value="{{ request('profissao') }}" class="form-control form-control-sm" placeholder="Profissão">
                </div>
                <div class="col-md-2">
                    <select name="nivel_academico" class="form-select form-select-sm">
                        <option value="">Nível académico</option>
                        <option value="secundario" {{ request('nivel_academico') == 'secundario' ? 'selected' : '' }}>Ensino Secundário</option>
                        <option value="bacharel" {{ request('nivel_academico') == 'bacharel' ? 'selected' : '' }}>Bacharelato / Bacharel</option>
                        <option value="licenciatura" {{ request('nivel_academico') == 'licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                        <option value="mestrado" {{ request('nivel_academico') == 'mestrado' ? 'selected' : '' }}>Mestrado</option>
                        <option value="doutoramento" {{ request('nivel_academico') == 'doutoramento' ? 'selected' : '' }}>Doutoramento</option>
                        <option value="outro" {{ request('nivel_academico') == 'outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" min="0" name="anos_experiencia_min" value="{{ request('anos_experiencia_min') }}" class="form-control form-control-sm" placeholder="Exp. mínima (anos)">
                </div>
                <div class="col-md-2">
                    <input type="text" name="competencia" value="{{ request('competencia') }}" class="form-control form-control-sm" placeholder="Competência">
                </div>
                <div class="col-md-2">
                    <input type="text" name="localizacao" value="{{ request('localizacao') }}" class="form-control form-control-sm" placeholder="Localização">
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn btn-sm btn-outline-secondary">Filtrar</button>
                </div>
            </div>
        </form>

        <div class="card-custom p-4 shadow-sm">
            <div class="pb-2 mb-3 border-bottom">
                <h6 class="fw-bold text-dark m-0">Processos de Candidatura Recebidos</h6>
            </div>

            <div class="table-scrollable-container">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Contacto</th>
                            <th>Vaga Pretendida</th>
                            <th>Data Submissão</th>
                            <th>Nível Académico</th>
                            <th>Anos Experiência</th>
                            <th>Competências</th>
                            <th class="text-center">Currículo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Ações de Mudar Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nivelLabels = [
                                'secundario' => 'Ensino Secundário',
                                'bacharel' => 'Bacharelato / Bacharel',
                                'licenciatura' => 'Licenciatura',
                                'mestrado' => 'Mestrado',
                                'doutoramento' => 'Doutoramento',
                                'outro' => 'Outro',
                            ];
                        @endphp
                        @forelse($candidaturas as $candidatura)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $candidatura->candidato_nome }}</div>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-envelope me-1"></i>{{ $candidatura->candidato_email }}</span>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-briefcase me-1"></i>{{ $candidatura->profissao ?? 'Profissão não informada' }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-phone me-1"></i>{{ $candidatura->candidato_telefone }}</span>
                                    <span class="text-muted small d-block"><i class="fa-solid fa-location-dot me-1"></i>{{ $candidatura->localizacao ?? 'Localização não informada' }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-secondary">{{ $candidatura->vaga_titulo }}</span>
                                </td>
                                <td class="small text-muted">
                                    {{ date('d/m/Y H:i', strtotime($candidatura->data_candidatura)) }}
                                </td>

                                <!-- Nível Académico -->
                                <td>
                                    <span class="fw-medium text-dark">{{ $nivelLabels[$candidatura->nivel_academico] ?? $candidatura->nivel_academico ?? 'Não informado' }}</span>
                                </td>

                                <!-- Anos de Experiência -->
                                <td>
                                    <span class="fw-medium text-dark">
                                        {{ isset($candidatura->anos_experiencia) ? $candidatura->anos_experiencia . ' ano(s)' : 'Não informado' }}
                                    </span>
                                </td>

                                <!-- Competências -->
                                <td>
                                    @if(!empty($candidatura->competencias))
                                        {{-- Caso as competências sejam armazenadas como texto separado por vírgula --}}
                                        @foreach(explode(',', $candidatura->competencias) as $skill)
                                            <span class="badge bg-light text-dark border me-1 mb-1">{{ trim($skill) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small">Nenhuma listada</span>
                                    @endif
                                </td>
                                <!-- Currículo -->
                                <td class="text-center">
                                    @if($candidatura->cv_especifico)
                                        <a href="{{ route('storage.file', ['path' => $candidatura->cv_especifico]) }}" target="_blank" class="btn btn-sm btn-light border text-dark fw-medium">
                                            <i class="fa-solid fa-file-pdf text-danger me-1"></i> Ver CV
                                        </a>
                                    @else
                                        <span class="text-muted small">Sem arquivo</span>
                                    @endif
                                    @if($candidatura->carta_especifico)
                                        <a href="{{ route('storage.file', ['path' => $candidatura->carta_especifico]) }}" target="_blank" class="btn btn-sm btn-light border text-dark fw-medium mt-1">
                                            <i class="fa-solid fa-file-lines text-warning me-1"></i> Carta
                                        </a>
                                    @endif
                                </td>

                                <!-- Estado -->
                                <td class="text-center">
                                    @if(strtolower($candidatura->status) == 'pendente')
                                        <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-1.5 rounded-5 fw-medium">Pendente</span>
                                    @elseif(strtolower($candidatura->status) == 'aceito')
                                        <span class="badge bg-success-subtle text-success border border-success px-3 py-1.5 rounded-5 fw-medium">Aceito</span>
                                    @elseif(strtolower($candidatura->status) == 'lista de espera')
                                        <span class="badge bg-purple-subtle text-purple border border-purple px-3 py-1.5 rounded-5 fw-medium" style="background-color: #f3e8ff; color: #6b21a8; border-color: #d8b4fe !important;">Lista de Espera</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1.5 rounded-5 fw-medium">Rejeitado</span>
                                    @endif
                                </td>

                                <!-- Ações -->
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">
                                        @if(strtolower($candidatura->status) != 'aceito')
                                            <form action="{{ route('candidatos.alterarStatus', $candidatura->candidatura_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Aceito">
                                                <button type="submit" class="btn btn-sm btn-outline-success fw-medium" title="Aceitar Candidato">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if(strtolower($candidatura->status) != 'lista de espera')
                                            <form action="{{ route('candidatos.alterarStatus', $candidatura->candidatura_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Lista de Espera">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary fw-medium" title="Mover para Lista de Espera">
                                                    <i class="fa-solid fa-clock"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if(strtolower($candidatura->status) != 'rejeitado')
                                            <form action="{{ route('candidatos.alterarStatus', $candidatura->candidatura_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Rejeitado">
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-medium" title="Rejeitar Candidato">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if(strtolower($candidatura->status) != 'pendente')
                                            <form action="{{ route('candidatos.alterarStatus', $candidatura->candidatura_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Pendente">
                                                <button type="submit" class="btn btn-sm btn-outline-dark fw-medium" title="Repor Pendente">
                                                    <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4 small">Nenhuma candidatura registada até ao momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="createCandidatoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #0d9488;">
                <h5 class="modal-title fw-bold">Registar Nova Candidatura</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('candidatos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start p-4">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Vaga Pretendida (Recrutamentos)</label>
                        <select name="vaga_id" class="form-select border-secondary-subtle" required>
                            <option value="" disabled selected>Selecione uma vaga disponível...</option>
                            @foreach($vagas as $vaga)
                                <option value="{{ $vaga->id }}">{{ $vaga->titulo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nome Completo</label>
                        <input type="text" name="nome" class="form-control border-secondary-subtle" placeholder="Nome do candidato" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Email de Contacto</label>
                        <input type="email" name="email" class="form-control border-secondary-subtle" placeholder="exemplo@eureka.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Telefone / WhatsApp</label>
                        <input type="text" name="telefone" class="form-control border-secondary-subtle" placeholder="Ex: +245..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Profissão</label>
                        <input type="text" name="profissao" class="form-control border-secondary-subtle" placeholder="Ex: Gestor de RH">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Nível Académico</label>
                            <select name="nivel_academico" class="form-select border-secondary-subtle">
                                <option value="">Selecionar...</option>
                                <option value="secundario">Ensino Secundário</option>
                                <option value="bacharel">Bacharelato / Bacharel</option>
                                <option value="licenciatura">Licenciatura</option>
                                <option value="mestrado">Mestrado</option>
                                <option value="doutoramento">Doutoramento</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Anos de Experiência</label>
                            <input type="number" min="0" name="anos_experiencia" class="form-control border-secondary-subtle" placeholder="Ex: 3">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Competências</label>
                        <input type="text" name="competencias" class="form-control border-secondary-subtle" placeholder="Ex: Excel avançado, Laravel, Recrutamento">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Localização</label>
                        <input type="text" name="localizacao" class="form-control border-secondary-subtle" placeholder="Ex: Bissau">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Ficheiro do Currículo (PDF, DOCX)</label>
                        <input type="file" name="cv_arquivo" class="form-control border-secondary-subtle" accept=".pdf,.doc,.docx" required>
                        <div class="form-text text-muted" style="font-size: 0.75rem;">Tamanho máximo permitido: 2MB.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Carta de Motivação (PDF, DOCX)</label>
                        <input type="file" name="carta_motivacao_arquivo" class="form-control border-secondary-subtle" accept=".pdf,.doc,.docx">
                        <div class="form-text text-muted" style="font-size: 0.75rem;">Opcional · Tamanho máximo permitido: 2MB.</div>
                    </div>

                </div>
                <div class="modal-footer bg-light border-top-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #0d9488;">Salvar Candidatura</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script do Bootstrap já existente -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Adiciona o Script de Pesquisa Dinâmica aqui: -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleciona o input de pesquisa e todas as linhas do corpo da tabela
        const searchInput = document.getElementById('searchCandidato');
        const tableRows = document.querySelectorAll('table tbody tr');

        // Escuta o evento de digitação (keyup) no campo de texto
        searchInput.addEventListener('keyup', function (e) {
            // Obtém o termo digitado, transforma em minúsculas e remove espaços extras nas pontas
            const searchTerm = e.target.value.toLowerCase().trim();

            tableRows.forEach(row => {
                // Se a tabela estiver vazia, ignora a linha de aviso "Nenhuma candidatura registada..."
                if (row.cells.length === 1 && row.querySelector('td').getAttribute('colspan')) {
                    return;
                }

                // Obtém todo o texto visível da linha (Nome, Email, Telefone, Vaga e Estado)
                const rowText = row.textContent.toLowerCase();

                // Verifica se o termo pesquisado existe em alguma parte da linha
                if (rowText.includes(searchTerm)) {
                    row.style.display = ''; // Mostra a linha se houver correspondência
                } else {
                    row.style.display = 'none'; // Esconde a linha se não houver correspondência
                }
            });
        });
    });
    function exportarCandidatosPDF() {
        // 1. Extrair os dados da tabela de candidatos presente no Blade
        const linhas = document.querySelectorAll(".table-scrollable-container table tbody tr");
        let linhasHTML = "";
        let totalCandidatos = 0;

        linhas.forEach(linha => {
            const colunas = linha.querySelectorAll("td");

            // Ignorar a linha de "Nenhum registo" ou tabelas vazias
            if (colunas.length < 6 || linha.innerText.includes("Nenhum registo")) return;

            const estado = colunas[8]?.innerText.trim() || 'Pendente';

            // Só os candidatos Aceitos entram na triagem do PDF
            if (!estado.toLowerCase().includes('aceito')) return;

            totalCandidatos++;

            const candidatoNome = colunas[0].querySelector('.fw-bold')?.innerText.trim() || colunas[0].innerText.trim();
            const candidatoSub = colunas[0].querySelector('.text-muted')?.innerText.trim() || '';
            const contacto = colunas[1]?.innerText.trim() || 'N/A';
            const vaga = colunas[2]?.innerText.trim() || 'N/A';
            const dataSubmissao = colunas[3]?.innerText.trim() || 'N/A';
            const nivelAcademico = colunas[4]?.innerText.trim() || 'N/A';
            const experiencia = colunas[5]?.innerText.trim() || 'N/A';
            const competencias = colunas[6]?.innerText.trim() || 'N/A';

            // Mapeamento de estilos dos badges de estado
            const st = estado.toLowerCase();
            let badgeClass = 'badge-pendente';
            if (st.includes('aceito') || st.includes('aprovado')) badgeClass = 'badge-aceito';
            else if (st.includes('espera')) badgeClass = 'badge-espera';
            else if (st.includes('rejeitado') || st.includes('recusado')) badgeClass = 'badge-rejeitado';

            linhasHTML += `
                <tr>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">${candidatoNome}</div>
                        <div style="font-size: 8pt; color: #64748b;">${candidatoSub}</div>
                    </td>
                    <td style="font-size: 7.5pt; color: #475569;">${contacto}</td>
                    <td style="font-weight: 600;">${vaga}</td>
                    <td style="text-align: center;">${dataSubmissao}</td>
                    <td>${nivelAcademico}</td>
                    <td style="text-align: center;">${experiencia}</td>
                    <td style="font-size: 7.5pt; color: #475569;">${competencias}</td>
                    <td style="text-align: center;">
                        <span class="badge ${badgeClass}">${estado}</span>
                    </td>
                </tr>
            `;
        });

        if (totalCandidatos === 0) {
            alert("Nenhum candidato aceito encontrado para exportar.");
            return;
        }

        // 2. Data atual para o relatório
        const dataEmissao = new Date().toLocaleDateString('pt-PT');

        // 3. Montar a estrutura HTML para renderização no PDF
        const container = document.createElement('div');
        container.innerHTML = `
            <style>
                .pdf-container {
                    font-family: 'Segoe UI', Arial, sans-serif;
                    padding: 15px;
                    color: #1e293b;
                    background-color: #ffffff;
                }
                .pdf-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border-bottom: 2px solid #0d9488;
                    padding-bottom: 12px;
                    margin-bottom: 15px;
                }
                .logo-box {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .logo-img {
                    width: 38px;
                    height: 38px;
                    border-radius: 50%;
                    object-fit: cover;
                }
                .company-title {
                    font-size: 14px;
                    font-weight: 800;
                    color: #0f172a;
                    text-transform: uppercase;
                    margin: 0;
                    line-height: 1.1;
                }
                .company-sub {
                    font-size: 9px;
                    color: #0d9488;
                    font-weight: 700;
                    letter-spacing: 0.8px;
                    text-transform: uppercase;
                    margin: 0;
                }
                .pdf-title-block {
                    text-align: right;
                }
                .pdf-title-block h2 {
                    margin: 0;
                    color: #0d9488;
                    font-size: 16px;
                    font-weight: 800;
                    text-transform: uppercase;
                }
                .pdf-title-block p {
                    margin: 2px 0 0 0;
                    font-size: 9px;
                    color: #64748b;
                }
                .kpi-cards {
                    display: flex;
                    gap: 10px;
                    margin-bottom: 15px;
                }
                .kpi-card {
                    flex: 1;
                    background: #f8fafc;
                    border: 1px solid #e2e8f0;
                    border-radius: 6px;
                    padding: 8px 10px;
                }
                .kpi-card-title {
                    font-size: 8px;
                    font-weight: 700;
                    color: #64748b;
                    text-transform: uppercase;
                }
                .kpi-card-value {
                    font-size: 14px;
                    font-weight: 800;
                    margin-top: 2px;
                    color: #0f172a;
                }
                .pdf-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 5px;
                }
                .pdf-table th {
                    background-color: #0d9488;
                    color: #ffffff;
                    font-size: 8pt;
                    font-weight: 700;
                    text-transform: uppercase;
                    padding: 6px 8px;
                    text-align: left;
                }
                .pdf-table td {
                    padding: 8px;
                    font-size: 8pt;
                    border-bottom: 1px solid #f1f5f9;
                }
                .pdf-table tr:nth-child(even) td {
                    background-color: #f8fafc;
                }
                .badge {
                    padding: 3px 8px;
                    border-radius: 10px;
                    font-size: 7.5pt;
                    font-weight: 700;
                    display: inline-block;
                }
                .badge-aceito { background-color: #d1fae5; color: #059669; }
                .badge-pendente { background-color: #fef3c7; color: #d97706; }
                .badge-espera { background-color: #f3e8ff; color: #6b21a8; }
                .badge-rejeitado { background-color: #fee2e2; color: #dc2626; }
                .footer-note {
                    margin-top: 25px;
                    padding-top: 10px;
                    border-top: 1px dashed #cbd5e1;
                    font-size: 7.5pt;
                    color: #94a3b8;
                    text-align: center;
                }
            </style>

            <div class="pdf-container">
                <!-- Cabeçalho -->
                <div class="pdf-header">
                    <div class="logo-box">
                        <img src="{{ asset('eureka.jpeg') }}" class="logo-img" alt="Eureka Consulting">
                        <div>
                            <div class="company-title">Eureka Consulting</div>
                            <div class="company-sub">Recursos Humanos</div>
                        </div>
                    </div>
                    <div class="pdf-title-block">
                        <h2>Banco de Candidatos</h2>
                        <p>Triagem &amp; Candidaturas Aceitas | Gerado em: ${dataEmissao}</p>
                    </div>
                </div>

                <!-- Resumo KPI -->
                <div class="kpi-cards">
                    <div class="kpi-card">
                        <div class="kpi-card-title">Candidatos Aceitos</div>
                        <div class="kpi-card-value" style="color: #0d9488;">${totalCandidatos} Registo(s)</div>
                    </div>
                </div>

                <!-- Tabela de Candidatos -->
                <table class="pdf-table">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Candidato</th>
                            <th style="width: 12%;">Contacto</th>
                            <th style="width: 16%;">Vaga Pretendida</th>
                            <th style="width: 11%; text-align: center;">Data Submissão</th>
                            <th style="width: 15%;">Nível Académico</th>
                            <th style="width: 8%; text-align: center;">Exp.</th>
                            <th style="width: 9%;">Competências</th>
                            <th style="width: 9%; text-align: center;">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${linhasHTML}
                    </tbody>
                </table>

                <div class="footer-note">
                    Este relatório inclui apenas candidaturas aceitas, para facilitar a triagem. Gerado automaticamente pelo Sistema Eureka RH.
                </div>
            </div>
        `;

        // 4. Configurações de exportação em orientação Landscape (Paisagem)
        const opt = {
            margin:       [8, 8, 8, 8],
            filename:     `relatorio_candidatos_${new Date().toISOString().slice(0, 10)}.pdf`,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, logging: false, useCORS: true },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        // 5. Executar a geração do PDF com html2pdf
        html2pdf().set(opt).from(container).save();
    }
</script>
@include('partials.theme-script')
</body>
</html>
