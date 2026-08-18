<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eureka RH - Folha Salarial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root { --accent: #0d9488; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; min-height: 100vh; margin: 0; }

        .wrapper { display: flex; width: 100%; min-height: 100vh; }

        /* Sidebar Fixa Igual às outras páginas */
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

        .badge-pago { background-color: #d1e7dd; color: #0f5132; }
        .badge-pendente { background-color: #fff3cd; color: #664d03; }

        .form-label-compact { font-size: 11px; font-weight: 600; color: #495057; margin-bottom: 2px; }
        .form-control-compact { padding: 4px 8px; font-size: 13px; border-radius: 6px; }
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
                <h2 class="fw-bold m-0 text-dark">Folha Salarial</h2>
                <p class="text-accent">Cálculo estruturado com impostos nacionais e controle automático de assiduidade</p>
            </div>

            <div class="d-flex gap-2">
                <!-- Botão Moderno de Exportar PDF -->
                <button type="button" onclick="exportarFolhaPDF()" class="btn btn-light border btn-sm fw-semibold rounded-3 d-inline-flex align-items-center gap-2 shadow-sm text-dark px-3" style="height: 38px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="12" y2="18"></line>
                        <line x1="15" y1="15" x2="12" y2="18"></line>
                    </svg>
                    Exportar PDF
                </button>

                <button class="btn text-white px-3 btn-sm fw-medium rounded-3" style="background-color: var(--accent); height: 38px;" data-bs-toggle="modal" data-bs-target="#modalGerarFolha">
                    ⚡ Rodar Folha do Mês
                </button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Total Líquido Emitido</span>
                    <h3 class="fw-bold my-1 text-dark">{{ number_format($totalGastoLiquido, 0, ',', '.') }} XOF</h3>
                    <span class="text-muted small">Valor total acumulado do mês</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Folhas Pagas</span>
                    <h3 class="fw-bold my-1 text-success">{{ $totalPagos }}</h3>
                    <span class="text-muted small">Transferências efetuadas</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom p-3 shadow-sm">
                    <span class="text-muted small fw-bold d-block text-uppercase">Folhas Pendentes</span>
                    <h3 class="fw-bold my-1 text-warning">{{ $totalPendentes }}</h3>
                    <span class="text-muted small">Aguardam liquidação</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                <span class="small fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="padding: 0.75rem;"></button>
            </div>
        @endif

        <div class="card-custom p-4">
        <div class="table-scrollable-container">
            <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Colaborador</th>
                            <th>Salário Bruto</th>
                            <th>INSS</th>
                            <th>Imposto Rendimento</th>
                            <th>Faltas (Dias)</th>
                            <th>Líquido Final</th>
                            <th>Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($folhas as $f)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $f->nome }}</div>
                                    <span class="text-muted small">{{ $f->cargo }}</span>
                                </td>
                                <td class="fw-medium">{{ number_format($f->salario_bruto, 0, ',', '.') }} XOF</td>
                                <td class="text-danger small" style="font-size: 11px; line-height: 1.4;">
                                    {{ number_format($f->inss, 0, ',', '.') }} XOF
                                </td>
                                <td class="text-danger small" style="font-size: 11px; line-height: 1.4;">
                                    {{ number_format($f->imposto_rendimento, 0, ',', '.') }} XOF
                                </td>
                                <td>
                                    <div class="fw-bold m-0">{{ $f->faltas }}</div>
                                    <span class="text-danger small" style="font-size: 11px;">-{{ number_format($f->desconto_faltas, 0, ',', '.') }} XOF</span>
                                </td>
                                <td class="fw-bold text-dark fs-6">{{ number_format($f->salario_liquido, 0, ',', '.') }} XOF</td>
                                <td>
                                    <span class="badge {{ $f->status == 'Pago' ? 'text-success bg-success-subtle' : 'text-warning bg-warning-subtle' }} px-3 py-1.5 rounded-5 fw-medium">
                                        {{ $f->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('folhas.status', ['id' => $f->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="{{ $f->status === 'Pago' ? 'Pendente' : 'Pago' }}">

                                        <button type="submit" class="btn btn-sm {{ $f->status === 'Pago' ? 'btn-outline-warning' : 'btn-outline-success' }} small px-2 py-1">
                                            <i class="bi {{ $f->status === 'Pago' ? 'bi-x-circle' : 'bi-check-circle' }} me-1"></i>
                                            Marcar como {{ $f->status === 'Pago' ? 'Pendente' : 'Pago' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4 small">Nenhum registo processado para o período selecionado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" id="modalGerarFolha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-light py-2 px-3">
                <h6 class="modal-title fw-bold m-0">Processamento Automático</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('folhas.gerar') }}" method="POST">
                @csrf
                <div class="modal-body p-3 text-center">
                    <p class="text-muted small mb-3">Selecione o período. O sistema cruzará os dados com o histórico de <strong>Presenças</strong> para aplicar os descontos de falta e impostos de forma autónoma.</p>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label-compact d-block text-start">Mês</label>
                            <input type="number" name="mes" value="{{ $mesSelecionado }}" min="1" max="12" class="form-control form-control-compact text-center" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label-compact d-block text-start">Ano</label>
                            <input type="number" name="ano" value="{{ $anoSelecionado }}" class="form-control form-control-compact text-center" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-1 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Gerar Tudo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function exportarFolhaPDF() {
    // 1. Extrair os dados da tabela presente no Blade
    const linhas = document.querySelectorAll(".table-scrollable-container table tbody tr");
    let linhasHTML = "";
    let totalBruto = 0;
    let totalLiquido = 0;
    let totalFuncionarios = 0;

    linhas.forEach(linha => {
        const colunas = linha.querySelectorAll("td");

        // Ignorar a linha de "Nenhum registo"
        if (colunas.length >= 7 && !linha.innerText.includes("Nenhum registo")) {
            totalFuncionarios++;

            const funcionario = colunas[0].querySelector('.fw-bold')?.innerText.trim() || '';
            const cargo = colunas[0].querySelector('.text-muted')?.innerText.trim() || '';
            const bruto = colunas[1].innerText.trim();
            const inss = colunas[2].innerText.trim();
            const ir = colunas[3].innerText.trim();
            const faltas = colunas[4].innerText.trim().replace(/\n/g, ' ');
            const liquido = colunas[5].innerText.trim();
            const estado = colunas[6].innerText.trim();

            const isPago = estado.toLowerCase().includes("pago");
            const badgeClass = isPago ? 'badge-pago' : 'badge-pendente';

            linhasHTML += `
                <tr>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">${funcionario}</div>
                        <div style="font-size: 8pt; color: #64748b;">${cargo}</div>
                    </td>
                    <td style="text-align: right; font-weight: 600;">${bruto}</td>
                    <td style="text-align: right; color: #dc2626;">${inss}</td>
                    <td style="text-align: right; color: #dc2626;">${ir}</td>
                    <td style="text-align: center;">${faltas}</td>
                    <td style="text-align: right; font-weight: 700; color: #0f172a;">${liquido}</td>
                    <td style="text-align: center;">
                        <span class="badge ${badgeClass}">${estado}</span>
                    </td>
                </tr>
            `;
        }
    });

    if (totalFuncionarios === 0) {
        alert("Nenhum registo de folha salarial encontrado para exportar.");
        return;
    }

    // 2. Extrair informações dos cards KPI da página
    const totalGastoLiquido = document.querySelector('.card-custom h3')?.innerText.trim() || '0 XOF';

    // 3. Montar a estrutura HTML para renderização no PDF
    const mesAno = "{{ $mesSelecionado }}/{{ $anoSelecionado }}";
    const dataEmissao = new Date().toLocaleDateString('pt-PT');

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
            .badge-pago { background-color: #d1e7dd; color: #0f5132; }
            .badge-pendente { background-color: #fff3cd; color: #664d03; }
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
            <!-- Cabeçalho com Logótipo Arredondado -->
            <div class="pdf-header">
                <div class="logo-box">
                    <img src="{{ asset('eureka.jpeg') }}" class="logo-img" alt="Eureka Consulting">
                    <div>
                        <div class="company-title">Eureka Consulting</div>
                        <div class="company-sub">Recursos Humanos</div>
                    </div>
                </div>
                <div class="pdf-title-block">
                    <h2>Folha Salarial</h2>
                    <p>Período: <strong>${mesAno}</strong> | Gerado em: ${dataEmissao}</p>
                </div>
            </div>

            <!-- Resumo Financeiro -->
            <div class="kpi-cards">
                <div class="kpi-card">
                    <div class="kpi-card-title">Total Processado</div>
                    <div class="kpi-card-value">${totalFuncionarios} Colaboradores</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-card-title">Total Líquido Emitido</div>
                    <div class="kpi-card-value" style="color: #0d9488;">${totalGastoLiquido}</div>
                </div>
            </div>

            <!-- Tabela da Folha Salarial -->
            <table class="pdf-table">
                <thead>
                    <tr>
                        <th style="width: 28%;">Colaborador / Cargo</th>
                        <th style="width: 15%; text-align: right;">S. Bruto</th>
                        <th style="width: 12%; text-align: right;">INSS</th>
                        <th style="width: 13%; text-align: right;">Imp. Rend.</th>
                        <th style="width: 12%; text-align: center;">Faltas</th>
                        <th style="width: 12%; text-align: right;">Líquido</th>
                        <th style="width: 8%; text-align: center;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    ${linhasHTML}
                </tbody>
            </table>

            <div class="footer-note">
                Este relatório foi gerado automaticamente pelo Sistema Eureka RH. Confirme os valores junto da direção financeira.
            </div>
        </div>
    `;

    // 4. Configurações de exportação (Orientação Paisagem / Landscape para caberem todas as colunas)
    const opt = {
        margin:       [8, 8, 8, 8],
        filename:     `folha_salarial_${mesAno.replace('/', '_')}.pdf`,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, logging: false, useCORS: true },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
    };

    // 5. Executar o download do PDF
    html2pdf().set(opt).from(container).save();
}
</script>
@include('partials.theme-script')
</body>
</html>
