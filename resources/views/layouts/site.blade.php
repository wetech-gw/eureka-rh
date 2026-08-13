<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Eureka Consulting — Consultoria empresarial na Guiné-Bissau e África Ocidental')</title>
<meta name="description" content="@yield('meta_description', 'Estratégia, finanças, gestão de projetos e aceleração de empresas. Consultoria de referência em Bissau e na África Ocidental.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
@stack('head')
</head>
<body>

<!-- ===== BARRA DE CONTACTO (topo) ===== -->
<div class="top-contact">
  <div class="container top-contact-inner">
    <span class="tc-item tc-phone">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h3l2 5-2 1a11 11 0 0 0 5 5l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg>
      <span>{{ $contact->phones ?? '+245 966 164 555 · +245 956 965 050' }}</span>
    </span>
    <span class="tc-item tc-mail">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
      <a href="mailto:{{ $contact->email ?? 'eureka@eurekaconsulting.com' }}">{{ $contact->email ?? 'eureka@eurekaconsulting.com' }}</a>
    </span>
    <span class="tc-item tc-hours">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
      <span>{{ $contact->schedule ?? 'Seg – Sex · 08h00 às 17h30' }}</span>
    </span>
  </div>
</div>

<!-- ===== CABEÇALHO ===== -->
<header class="site-header" id="topo">
  <div class="container header-inner">
    <a href="{{ route('site.inicio') }}" class="brand" aria-label="Eureka Consulting — início">
      <img src="{{ asset('eureka.jpeg') }}" class="brand-logo" alt="Eureka Consulting">
    </a>

    <nav class="main-nav" id="mainNav" aria-label="Navegação principal">
      <a href="{{ route('site.inicio') }}" data-i18n="nav.top" class="{{ request()->routeIs('site.inicio') ? 'active' : '' }}">Início</a>
      <a href="{{ route('site.servicos') }}" data-i18n="nav.servicos" class="{{ request()->routeIs('site.servicos') ? 'active' : '' }}">Serviços</a>
      <a href="{{ route('site.inicio') }}#recrutamento" data-i18n="nav.recrutamento">Vagas & Formações</a>
      <a href="{{ route('site.recursos') }}" data-i18n="nav.recursos" class="{{ request()->routeIs('site.recursos') ? 'active' : '' }}">Recursos</a>
      <a href="{{ route('site.sobre') }}" data-i18n="nav.sobre" class="{{ request()->routeIs('site.sobre') ? 'active' : '' }}">Sobre</a>
      <a href="{{ route('site.noticias') }}" data-i18n="nav.noticias" class="{{ request()->routeIs('site.noticias') ? 'active' : '' }}">Notícias</a>
      <a href="{{ route('site.inicio') }}#contacto" data-i18n="nav.contacto">Contacto</a>
      <div class="nav-mobile-extra">
          <div class="lang-switch" role="group" aria-label="Idioma">
              @include('partials.lang-switch')
          </div>
        <a href="{{ route('site.inicio') }}#contacto" class="btn btn-primary" data-i18n="nav.cta">Solicitar consultoria</a>
      </div>
    </nav>

    <div class="header-actions">
        <div class="lang-switch" role="group" aria-label="Idioma">
            @include('partials.lang-switch')
        </div>
      <a href="{{ route('site.inicio') }}#contacto" class="btn btn-primary" data-i18n="nav.cta">Solicitar consultoria</a>
      <button class="menu-toggle" id="menuToggle" aria-label="Menu" aria-expanded="false" aria-controls="mainNav">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<main>
@yield('content')
</main>

<!-- ===== RODAPÉ ===== -->
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <img src="{{ asset('eureka.jpeg') }}" class="footer-logo" alt="Eureka Consulting">
      <p data-i18n="footer.desc">Consultoria empresarial de referência na Guiné-Bissau e na África Ocidental. Estratégia, finanças e crescimento — ao seu lado.</p>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.nav">Navegação</h4>
      <a href="{{ route('site.inicio') }}#recrutamento" data-i18n="nav.recrutamento">Vagas & Formações</a>
      <a href="{{ route('site.servicos') }}" data-i18n="nav.servicos">Serviços</a>
      <a href="{{ route('site.recursos') }}" data-i18n="nav.recursos">Recursos</a>
      <a href="{{ route('site.sobre') }}" data-i18n="nav.sobre">Sobre</a>
      <a href="{{ route('site.inicio') }}#boost">BOOST_ME</a>
      <a href="{{ route('site.noticias') }}" data-i18n="nav.noticias">Notícias</a>
      <a href="{{ route('site.inicio') }}#contacto" data-i18n="nav.contacto">Contacto</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.svc">Serviços</h4>
      <a href="{{ route('site.servicos') }}" data-i18n="svc.gestao.t">Gestão e Estratégia</a>
      <a href="{{ route('site.servicos') }}" data-i18n="svc.financas.t">Finanças e Auditoria</a>
      <a href="{{ route('site.servicos') }}" data-i18n="svc.projetos.t">Gestão de Projetos</a>
      <a href="{{ route('site.servicos') }}" data-i18n="svc.microfin.t">Microfinanças</a>
      <a href="{{ route('site.servicos') }}" data-i18n="svc.formacoes.t">Formações</a>
    </div>
    <div class="footer-col">
      <h4 data-i18n="footer.contact">Contacto</h4>
      <p>{{ $contact->address ?? 'Av. Dr. Koumba Yalá — Antula, Bissau' }}</p>
      @foreach(collect(explode('·', $contact->phones ?? ''))->filter() as $phone)
        <p>{{ trim($phone) }}</p>
      @endforeach
      @if(empty($contact->phones))
        <p>+245 966 164 555</p>
        <p>+245 956 965 050</p>
      @endif
      <p>{{ $contact->email ?? 'eureka@eurekaconsulting.com' }}</p>
    </div>
  </div>
  <div class="footer-bar">
    <div class="container footer-bar-inner">
      <p>© <span id="year"></span> Eureka Consulting. <span data-i18n="footer.rights">Todos os direitos reservados.</span></p>
      <nav class="footer-legal" aria-label="Avisos legais">
        <a href="#" data-i18n="footer.privacy">Política de privacidade</a>
        <a href="#" data-i18n="footer.legal">Aviso legal</a>
      </nav>
      <a href="{{ route('login') }}" class="btn btn-line-light footer-admin-btn">
        <i class="fa-solid fa-lock" style="font-size:.78rem"></i> <span data-i18n="footer.admin">Admin</span>
      </a>
    </div>
  </div>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
@stack('scripts')
</body>
</html>
