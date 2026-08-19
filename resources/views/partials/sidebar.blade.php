<button class="mobile-menu-toggle" aria-label="Menu">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
</button>
<div class="sidebar-overlay"></div>
<aside class="sidebar border-end p-3 d-flex flex-column" style="min-height: 100vh;">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('eureka.jpeg') }}" alt="EUREKA Consulting" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 1rem;">
        </a>
    </div>

    <nav class="flex-grow-1" style="overflow-y: auto; min-height: 0; scrollbar-width: thin; scrollbar-color: #d4d4d4 transparent;">
        <a href="{{ route('dashboard') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
            Dashboard
        </a>

        <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Recursos Humanos</div>

        <a href="{{ route('funcionarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('funcionarios*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            Funcionarios
        </a>

        <a href="{{ route('ferias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('ferias*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Férias & Licenças
        </a>

        <a href="{{ route('avaliacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('avaliacoes*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Avaliações
        </a>

        <a href="{{ route('formacoes.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('formacoes*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Formações
        </a>

        <a href="{{ route('presencas.index')}}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('presencas*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="9" r="7"></circle><polyline points="9 5 9 9 11.5 10.5"></polyline></svg>
            Presenças
        </a>

        <a href="{{ route('folhas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('folhas*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12.5 2h-7a1.5 1.5 0 0 0-1.5 1.5v11A1.5 1.5 0 0 0 5.5 16h7a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 12.5 2z"></path>
                <path d="M7 6h4"></path>
                <path d="M7 9h4"></path>
                <path d="M7 12h2"></path>
            </svg>
            Folha-Salarial
        </a>

        <a href="{{ route('recrutamento.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('recrutamento*') ? 'active' : '' }}" style="text-decoration: none;">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="14" height="11" rx="1.5"></rect>
                <path d="M6 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1"></path>
            </svg>
            Recrutamentos
        </a>

        <a href="{{ route('candidatos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('candidatos*') ? 'active' : '' }}" style="text-decoration: none;">
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

        <a href="{{ route('documentos.colaboradores.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('documentos.colaboradores*') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
            </svg>
            Dossiê do Colaborador
        </a>

        <a href="{{ route('estagiarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('estagiarios*') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>
            Gestão de Estagiários
        </a>

        <a href="{{ route('contact-messages.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('contact-messages*') ? 'active' : '' }}" style="text-decoration: none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="opacity: 0.9;">
                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/>
            </svg>
            Mensagens
            @if(($mensagensNaoLidas ?? 0) > 0)
                <span class="badge rounded-pill text-white ms-auto" style="background-color: #dc3545; font-size: 10px;">{{ $mensagensNaoLidas }}</span>
            @endif
        </a>

        <a href="{{ route('usuarios.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('usuarios*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            Utilizadores / Acessos
        </a>

        @if(Auth::user()->role === 'Responsável')
        <a href="{{ route('activity-logs.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 d-flex align-items-center gap-2 {{ request()->routeIs('activity-logs*') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Atividade Recente
            @if(($atividadesNaoVistas ?? 0) > 0)
                <span class="badge rounded-pill text-white ms-auto" style="background-color: #dc3545; font-size: 10px;">{{ $atividadesNaoVistas }}</span>
            @endif
        </a>
        @endif

        @if(in_array(Auth::user()->role, ['Responsável', 'CEO', 'Assistente']))
        <div class="text-uppercase text-muted fw-bold mt-3 mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Site Público</div>

        <a href="{{ route('admin.inicio.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.inicio*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11 12 4l9 7v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"></path><path d="M9 22V12h6v10"></path></svg>
            Início (Hero)
        </a>

        <a href="{{ route('admin.estatisticas.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.estatisticas*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Estatísticas (Hero)
        </a>

        <a href="{{ route('admin.boost.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.boost*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 15c-1.5 1.5-2 5-2 5s3.5-.5 5-2"/><path d="M9 15s5-1 8-4 4-8 4-8-5 1-8 4-4 8-4 8Z"/><circle cx="14.5" cy="9.5" r="1.5"/></svg>
            BOOST_ME
        </a>

        <a href="{{ route('admin.servicos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.servicos*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"></path></svg>
            Serviços
        </a>

        <a href="{{ route('admin.recursos.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.recursos*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
            Recursos
        </a>

        <a href="{{ route('admin.sobre.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.sobre*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"></path></svg>
            Sobre
        </a>

        <a href="{{ route('admin.noticias.index') }}" class="nav-item-hr p-2.5 rounded-3 mb-1 {{ request()->routeIs('admin.noticias*') ? 'active' : '' }}" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
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
