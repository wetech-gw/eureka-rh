@extends('layouts.site')

@section('title', 'Eureka Consulting — Consultoria empresarial na Guiné-Bissau e África Ocidental')

@section('content')

<!-- ===== HERO ===== -->
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-copy">
      @if($hero)
        <span class="eyebrow">{{ $hero->subtitle ?? 'Consultoria empresarial · Bissau & África Ocidental' }}</span>
        <h1>{!! $hero->title !!}</h1>
        <p class="lede">{{ $hero->description ?? ($hero->subtitle ?? 'Acompanhamos empresas, instituições e empreendedores com estratégia, finanças e gestão de projetos — do diagnóstico aos resultados medidos.') }}</p>
      @else
        <span class="eyebrow" data-i18n="hero.eyebrow">Consultoria empresarial · Bissau & África Ocidental</span>
        <h1 data-i18n-html="hero.title">Estruturamos negócios que <span class="ink-accent">crescem</span> no terreno africano.</h1>
        <p class="lede" data-i18n="hero.lede">Acompanhamos empresas, instituições e empreendedores com estratégia, finanças e gestão de projetos — do diagnóstico aos resultados medidos.</p>
      @endif
      <div class="hero-cta">
        <a href="{{ route('site.servicos') }}" class="btn btn-primary btn-lg" data-i18n="hero.cta1">Conhecer os serviços</a>
        <a href="#contacto" class="btn btn-line btn-lg" data-i18n="hero.cta2">Entrar em contacto</a>
      </div>
    </div>

    <figure class="hero-media">
      <img src="{{ $hero->image_path ? asset('storage/' . $hero->image_path) : asset('assets/hero.webp') }}" alt="Equipa da Eureka Consulting em reunião de trabalho"
           width="720" height="820" loading="eager"
           onerror="this.closest('.hero-media').classList.add('no-img')">
      <figcaption class="hero-media-fallback" aria-hidden="true">
        <span class="discs"><i></i><i></i><i></i></span>
        <small>assets/hero.webp</small>
      </figcaption>
    </figure>
  </div>

  <div class="container hero-stats-wrap">
    <ul class="hero-stats">
      @forelse($stats as $stat)
        <li><strong>{{ $stat->value }}<span>{{ $stat->suffix }}</span></strong><span class="hs-label">{{ $stat->label }}</span></li>
      @empty
        <li><strong>10<span>+</span></strong><span class="hs-label" data-i18n="hero.stat1">anos de experiência</span></li>
        <li><strong>200<span>+</span></strong><span class="hs-label" data-i18n="hero.stat2">clientes acompanhados</span></li>
        <li><strong>{{ $services->count() }}<span>+</span></strong><span class="hs-label" data-i18n="hero.stat3">serviços especializados</span></li>
      @endforelse
    </ul>
  </div>
</section>

<!-- ===== SERVIÇOS ===== -->
<section class="section" id="servicos">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow" data-i18n="sec.servicos.eyebrow">O que fazemos</span>
      <h2 data-i18n="sec.servicos.title">Serviços especializados, do diagnóstico à execução</h2>
      <p data-i18n="sec.servicos.desc">Competências multidisciplinares para cada fase do percurso empresarial, desenhadas para o contexto local.</p>
    </header>
    <div class="services-grid">
      @forelse($services as $service)
      <article class="service-card reveal{{ $service->is_featured ? ' feat' : '' }}">
        <div class="svc-icon">
          @if($service->icon && \Illuminate\Support\Str::contains($service->icon, '<'))
            {!! $service->icon !!}
          @else
            <i class="{{ $service->icon ?: 'fa-solid fa-briefcase' }}"></i>
          @endif
        </div>
        <h3>{{ $service->title }}</h3>
        <p>{{ $service->description }}</p>
        <a href="#contacto" class="svc-more"><span data-i18n="svc.more">Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      @empty
      <article class="service-card reveal">
        <div class="svc-icon"><i class="fa-solid fa-briefcase"></i></div>
        <h3 data-i18n="svc.consultoria.t">Consultoria</h3>
        <p data-i18n="svc.consultoria.d">Aconselhamento estratégico transversal para decisões empresariais mais seguras.</p>
        <a href="#contacto" class="svc-more"><span data-i18n="svc.more">Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      <article class="service-card reveal">
        <div class="svc-icon"><i class="fa-solid fa-chart-line"></i></div>
        <h3 data-i18n="svc.gestao.t">Gestão e Estratégia</h3>
        <p data-i18n="svc.gestao.d">Estruturação, planeamento e otimização de operações orientadas a resultados.</p>
        <a href="#contacto" class="svc-more"><span data-i18n="svc.more">Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== RECRUTAMENTO E FORMAÇÕES ===== -->
<section class="section section-tint" id="recrutamento">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow" data-i18n="sec.rec.eyebrow">Carreiras & Capacitação</span>
      <h2 data-i18n="sec.rec.title">Oportunidades de Recrutamento e Formações</h2>
      <p data-i18n="sec.rec.desc">Consulte os processos seletivos abertos e a agenda das nossas formações.</p>
    </div>

    <div class="search-box">
      <i class="fa-solid fa-search search-icon"></i>
      <input type="text" id="searchVagas" placeholder="Pesquisar por vaga, departamento..." data-i18n-placeholder="sec.rec.searchPh">
    </div>

    <!-- Vagas em cima -->
    <div class="grid-vagas" id="listaVagas"><p style="color: var(--muted);" data-i18n="sec.rec.loadVagas">A carregar vagas...</p></div>

    <!-- Formações por baixo -->
    <h3 class="sub-section-title" style="margin-top: 56px;"><i class="fa-solid fa-graduation-cap" style="color:var(--clay);margin-right:8px"></i><span data-i18n="sec.rec.subtitle">Formações & Workshops</span></h3>
    <div class="grid-formacoes" id="listaFormacoes" style="margin-top: 18px;"><p style="color: var(--muted);" data-i18n="sec.rec.loadFormacoes">A carregar formações...</p></div>

    <!-- Formulário de candidatura (oculto, abre ao clicar em Candidatar-se) -->
    <div class="candidatura-panel" id="candidaturaPanel" style="display:none; margin-top: 56px;">
      <div class="candidatura-panel-head">
        <h3><i class="fa-solid fa-paper-plane" style="color:var(--clay);margin-right:8px"></i><span data-i18n="cand.title">Candidatar-se a uma vaga</span></h3>
        <button type="button" class="btn-close-cand" id="btnFecharCandidatura" aria-label="Fechar">&times;</button>
      </div>
      <form action="{{ route('public.candidatar') }}" method="POST" enctype="multipart/form-data" id="candidaturaForm">
        @csrf
        <div class="candidatura-panel-body">
          <div class="form-feedback" id="candFeedback"></div>
          <div class="field">
            <label data-i18n-html="cand.vaga">Vaga Pretendida <span>*</span></label>
            <select name="vaga_id" id="candidatarVaga" required>
              <option value="" disabled selected data-i18n="cand.vagaPh">Selecione a vaga...</option>
            </select>
          </div>
          <div class="field-row">
            <div class="field">
              <label data-i18n-html="cand.nome">Nome Completo <span>*</span></label>
              <input type="text" name="nome" placeholder="Nome completo" data-i18n-placeholder="cand.nomePh" required>
            </div>
            <div class="field">
              <label data-i18n-html="cand.email">Email <span>*</span></label>
              <input type="email" name="email" placeholder="exemplo@email.com" data-i18n-placeholder="cand.emailPh" required>
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label data-i18n-html="cand.tel">Telefone <span>*</span></label>
              <input type="text" name="telefone" placeholder="+245..." data-i18n-placeholder="cand.telPh" required>
            </div>
            <div class="field">
              <label data-i18n="cand.prof">Profissão</label>
              <input type="text" name="profissao" placeholder="Ex: Gestor de RH" data-i18n-placeholder="cand.profPh">
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label data-i18n="cand.nivel">Nível Académico</label>
              <select name="nivel_academico">
                <option value="" data-i18n="cand.nivelPh">Selecionar...</option>
                <option value="Secundário" data-i18n="cand.nivelSec">Secundário</option>
                <option value="Licenciatura" data-i18n="cand.nivelLic">Licenciatura</option>
                <option value="Mestrado" data-i18n="cand.nivelMes">Mestrado</option>
                <option value="Doutoramento" data-i18n="cand.nivelDoc">Doutoramento</option>
              </select>
            </div>
            <div class="field">
              <label data-i18n="cand.exp">Anos de Experiência</label>
              <input type="number" min="0" name="anos_experiencia" placeholder="Ex: 3" data-i18n-placeholder="cand.expPh">
            </div>
          </div>
          <div class="field-row">
            <div class="field">
              <label data-i18n="cand.comp">Competências</label>
              <input type="text" name="competencias" placeholder="Ex: Excel avançado, Laravel" data-i18n-placeholder="cand.compPh">
            </div>
            <div class="field">
              <label data-i18n="cand.loc">Localização</label>
              <input type="text" name="localizacao" placeholder="Ex: Bissau" data-i18n-placeholder="cand.locPh">
            </div>
          </div>
          <div class="field">
            <label data-i18n-html="cand.cv">Currículo (PDF ou DOCX) <span>*</span></label>
            <input type="file" name="cv_arquivo" accept=".pdf,.doc,.docx" required>
            <small style="color:var(--muted);font-size:.78rem;margin-top:4px;display:block" data-i18n="cand.cvHint">Tamanho máximo: 2MB</small>
          </div>
          <div class="candidatura-actions">
            <button type="button" class="btn btn-line" id="btnCancelarCandidatura" data-i18n="cand.cancel">Cancelar</button>
            <button type="submit" class="btn btn-accent">
              <i class="fa-solid fa-paper-plane"></i> <span data-i18n="cand.submit">Enviar Candidatura</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- ===== DIFERENCIAIS ===== -->
<section class="section diff" id="diferenciais">
  <div class="container diff-grid">
    <div class="diff-intro">
      <span class="eyebrow" data-i18n="sec.diff.eyebrow">Porquê a Eureka</span>
      <h2 data-i18n="sec.diff.title">Conhecemos o terreno onde a sua empresa cresce</h2>
      <p data-i18n="sec.diff.desc">Rigor técnico com proximidade real ao mercado africano. Trabalhamos lado a lado com cada cliente, do diagnóstico aos resultados.</p>
      <a href="#contacto" class="btn btn-primary" data-i18n="sec.diff.cta">Falar com um consultor</a>
    </div>
    <ul class="diff-list">
      <li class="diff-item reveal"><span class="di-num">01</span><h3 data-i18n="diff.1.t">Conhecimento do contexto local</h3><p data-i18n="diff.1.d">Dominamos as especificidades do mercado da Guiné-Bissau e da região.</p></li>
      <li class="diff-item reveal"><span class="di-num">02</span><h3 data-i18n="diff.2.t">Experiência no mercado africano</h3><p data-i18n="diff.2.d">Mais de uma década a apoiar organizações em vários setores.</p></li>
      <li class="diff-item reveal"><span class="di-num">03</span><h3 data-i18n="diff.3.t">Soluções personalizadas</h3><p data-i18n="diff.3.d">Cada projeto desenhado à medida da realidade do cliente.</p></li>
      <li class="diff-item reveal"><span class="di-num">04</span><h3 data-i18n="diff.4.t">Equipa multidisciplinar</h3><p data-i18n="diff.4.d">Especialistas em finanças, estratégia, projetos e capital humano.</p></li>
      <li class="diff-item reveal"><span class="di-num">05</span><h3 data-i18n="diff.5.t">Acompanhamento estratégico</h3><p data-i18n="diff.5.d">Presença próxima do diagnóstico à implementação.</p></li>
      <li class="diff-item reveal"><span class="di-num">06</span><h3 data-i18n="diff.6.t">Compromisso com resultados</h3><p data-i18n="diff.6.d">Medimos o sucesso pelo impacto real nos negócios.</p></li>
    </ul>
  </div>
</section>

<!-- ===== RECURSOS ===== -->
<section class="section section-tint" id="recursos">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow" data-i18n="sec.res.eyebrow">Recursos para empreendedores</span>
      <h2 data-i18n="sec.res.title">Instituições que apoiam quem constrói</h2>
      <p data-i18n="sec.res.desc">Organizações de referência no financiamento e no apoio ao empreendedorismo na sub-região.</p>
    </header>
    <div class="resources-grid">
      @forelse($resources as $resource)
      <article class="resource-card reveal">
        <div class="res-logo">
          @if($resource->logo_path)
            <img src="{{ asset('storage/' . $resource->logo_path) }}" alt="{{ $resource->title }}" onerror="this.closest('.res-logo').innerHTML='<span>'+this.alt.slice(0,2).toUpperCase()+'</span>'">
          @else
            <span>{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::limit($resource->title, 6, '')) }}</span>
          @endif
        </div>
        <h3>{{ $resource->title }}</h3>
        <p>{{ $resource->description }}</p>
        <a href="{{ $resource->link ?: '#' }}" class="res-link" target="_blank" rel="noopener"><span data-i18n="res.visit">Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      @empty
      <article class="resource-card reveal">
        <div class="res-logo"><span>DER/FJ</span></div>
        <h3>DER/FJ</h3>
        <p data-i18n="res.1.d">Apoio ao desenvolvimento e financiamento de jovens empreendedores.</p>
        <a href="#" class="res-link" target="_blank" rel="noopener"><span data-i18n="res.visit">Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== SOBRE ===== -->
<section class="section section-dark" id="sobre">
  <div class="container about-grid">
    <div class="about-main">
      @if($about)
        <span class="eyebrow eyebrow-light" data-i18n="sec.about.eyebrow">Sobre a Eureka</span>
        <h2>{{ $about->title }}</h2>
        <p>{{ $about->description }}</p>
        <div class="mv-grid">
          <div class="mv-card">
            <h3 data-i18n="sec.about.missao">Missão</h3>
            <p>{{ $about->mission ?? 'Capacitar empresas e empreendedores com soluções estratégicas que geram crescimento sustentável e impacto positivo na economia da região.' }}</p>
          </div>
          <div class="mv-card">
            <h3 data-i18n="sec.about.visao">Visão</h3>
            <p>{{ $about->vision ?? 'Ser a consultora de referência na África Ocidental, reconhecida pela proximidade, competência e resultados que transformam negócios.' }}</p>
          </div>
        </div>
      @else
        <span class="eyebrow eyebrow-light" data-i18n="sec.about.eyebrow">Sobre a Eureka</span>
        <h2 data-i18n="sec.about.title">Uma parceira que entende o contexto empresarial africano</h2>
        <p data-i18n="sec.about.p1">Nascida em Bissau, a Eureka Consulting cresceu ao ritmo das empresas que acompanha. Ajudamos organizações a estruturar-se, a decidir melhor e a expandir-se com confiança por toda a África Ocidental.</p>
        <p data-i18n="sec.about.p2">A nossa equipa multidisciplinar reúne especialistas em estratégia, finanças, gestão de projetos e desenvolvimento de negócios, com um compromisso comum: resultados reais e duradouros.</p>
        <div class="mv-grid">
          <div class="mv-card">
            <h3 data-i18n="sec.about.missao">Missão</h3>
            <p data-i18n="sec.about.missaoD">Capacitar empresas e empreendedores com soluções estratégicas que geram crescimento sustentável e impacto positivo na economia da região.</p>
          </div>
          <div class="mv-card">
            <h3 data-i18n="sec.about.visao">Visão</h3>
            <p data-i18n="sec.about.visaoD">Ser a consultora de referência na África Ocidental, reconhecida pela proximidade, competência e resultados que transformam negócios.</p>
          </div>
        </div>
      @endif
    </div>
    <aside class="about-side">
      <figure class="about-photo">
        <img src="{{ $about->image_path ? asset('storage/' . $about->image_path) : asset('assets/sobre.webp') }}" alt="Escritório da Eureka Consulting em Bissau"
             width="480" height="300" loading="lazy"
             onerror="this.closest('.about-photo').classList.add('no-img')">
        <figcaption aria-hidden="true"><small>assets/sobre.webp</small></figcaption>
      </figure>
      <h3 data-i18n="sec.about.areas">Áreas de atuação</h3>
      <ul class="area-list">
        <li data-i18n="sec.about.area1">Estratégia e gestão empresarial</li>
        <li data-i18n="sec.about.area2">Finanças, contabilidade e fiscalidade</li>
        <li data-i18n="sec.about.area3">Microfinanças e inclusão financeira</li>
        <li data-i18n="sec.about.area4">Gestão e avaliação de projetos</li>
        <li data-i18n="sec.about.area5">Capital humano e formação</li>
        <li data-i18n="sec.about.area6">Estudos socioeconómicos</li>
      </ul>
      <p class="presence"><strong data-i18n="sec.about.presence">Presença regional: Guiné-Bissau · África Ocidental</strong></p>
    </aside>
  </div>
</section>

<!-- ===== VALORES ===== -->
<section class="section" id="valores">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow" data-i18n="sec.val.eyebrow">O que nos guia</span>
      <h2 data-i18n="sec.val.title">Valores que sustentam cada projeto</h2>
    </header>
    <ul class="values-list">
      <li class="reveal" data-i18n="val.1">Profissionalismo</li>
      <li class="reveal" data-i18n="val.2">Responsabilidade</li>
      <li class="reveal" data-i18n="val.3">Honestidade</li>
      <li class="reveal" data-i18n="val.4">Integridade</li>
      <li class="reveal" data-i18n="val.5">Gratidão</li>
      <li class="reveal" data-i18n="val.6">Inovação</li>
      <li class="reveal" data-i18n="val.7">Disciplina</li>
    </ul>
  </div>
</section>

<!-- ===== HISTÓRIA ===== -->
<section class="section section-tint" id="historia">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow" data-i18n="sec.hist.eyebrow">O nosso percurso</span>
      <h2 data-i18n="sec.hist.title">Uma história de crescimento contínuo</h2>
    </header>
    <ol class="timeline">
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.1.meta">Os primeiros passos</p><h3 class="tl-phase" data-i18n="hist.1.fase">Criação</h3><p data-i18n="hist.1.d">A Eureka nasce em Bissau com a missão de aproximar consultoria de qualidade das empresas locais.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.2.meta">Consolidação</p><h3 class="tl-phase" data-i18n="hist.2.fase">Crescimento</h3><p data-i18n="hist.2.d">Alargamento da carteira de serviços e da equipa multidisciplinar.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.3.meta">Para além das fronteiras</p><h3 class="tl-phase" data-i18n="hist.3.fase">Expansão Africana</h3><p data-i18n="hist.3.d">Projetos e parcerias em vários países da África Ocidental.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.4.meta">O próximo capítulo</p><h3 class="tl-phase" data-i18n="hist.4.fase">Visão Futura</h3><p data-i18n="hist.4.d">Aceleração de empresas, inovação e ligação a redes internacionais de investimento.</p></li>
    </ol>
  </div>
</section>

<!-- ===== BOOST_ME ===== -->
<section class="section boost" id="boost">
  <div class="container boost-grid @if($boost && $boost->image_path) has-media @endif">
    <div class="boost-copy">
      @if($boost)
        <span class="eyebrow eyebrow-light">{{ $boost->eyebrow ?: 'Programa de aceleração' }}</span>
        <h2>{!! $boost->title ?: '<span class="boost-name">BOOST_ME</span><br>Acelerador de Empresas' !!}</h2>
        <p>{{ $boost->description }}</p>
        @if($boost->features)
        <ul class="boost-feats">
          @foreach(preg_split('/\R/', trim($boost->features)) as $feat)
            @if(trim($feat) !== '')
              <li>{{ trim($feat) }}</li>
            @endif
          @endforeach
        </ul>
        @endif
        <div class="boost-cta">
          @if($boost->cta1)<a href="#contacto" class="btn btn-accent">{{ $boost->cta1 }}</a>@endif
          @if($boost->cta2)<a href="#contacto" class="btn btn-line-light">{{ $boost->cta2 }}</a>@endif
          @if($boost->cta3)<a href="#contacto" class="btn btn-line-light">{{ $boost->cta3 }}</a>@endif
        </div>
      @else
        <span class="eyebrow eyebrow-light" data-i18n="sec.boost.eyebrow">Programa de aceleração</span>
        <h2 data-i18n-html="sec.boost.title"><span class="boost-name">BOOST_ME</span><br>Acelerador de Empresas</h2>
        <p data-i18n="sec.boost.desc">Um programa desenhado para apoiar empreendedores e empresas no desenvolvimento, estruturação e crescimento dos seus negócios. Da ideia à escala, acompanhamos cada etapa com mentoria, ferramentas e acesso a redes de financiamento.</p>
        <ul class="boost-feats">
          <li data-i18n="sec.boost.f1">Diagnóstico e estruturação do negócio</li>
          <li data-i18n="sec.boost.f2">Mentoria estratégica personalizada</li>
          <li data-i18n="sec.boost.f3">Preparação para financiamento e investimento</li>
        </ul>
        <div class="boost-cta">
          <a href="#contacto" class="btn btn-accent" data-i18n="sec.boost.cta1">Conhecer o programa</a>
          <a href="#contacto" class="btn btn-line-light" data-i18n="sec.boost.cta2">Candidatar-se</a>
          <a href="#contacto" class="btn btn-line-light" data-i18n="sec.boost.cta3">Solicitar informações</a>
        </div>
      @endif
    </div>
    @if($boost && $boost->image_path)
    <div class="boost-media reveal">
      <img src="{{ asset('storage/' . $boost->image_path) }}" alt="BOOST_ME — Acelerador de Empresas" loading="lazy">
    </div>
    @endif
  </div>
</section>

<!-- ===== NOTÍCIAS ===== -->
<section class="section" id="noticias">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow" data-i18n="sec.news.eyebrow">Atualidade</span>
      <h2 data-i18n="sec.news.title">Notícias e perspetivas de mercado</h2>
      <p data-i18n="sec.news.desc">Análises sobre economia, negócios e empreendedorismo na Guiné-Bissau e na região.</p>
    </header>
    <div class="news-grid">
      @forelse($news as $new)
      <article class="news-card reveal">
        <div class="news-thumb">
          <span class="news-cat">{{ $new->category }}</span>
          <img src="{{ $new->image_path ? asset('storage/' . $new->image_path) : asset('assets/noticia-1.webp') }}" alt="{{ $new->title }}" loading="lazy"
               onerror="this.closest('.news-thumb').classList.add('no-img')">
          <span class="nt-fallback"><span class="discs"><i></i><i></i><i></i></span><small>{{ $new->category }}</small></span>
        </div>
        <div class="news-body">
          <span class="news-date">{{ $new->published_at ? $new->published_at->format('d M Y') : '' }}</span>
          <h3>{{ $new->title }}</h3>
          <p>{{ \Illuminate\Support\Str::limit($new->content, 120) }}</p>
          <a href="{{ route('site.noticias') }}#noticia-{{ $new->id }}" class="news-read"><span data-i18n="news.read">Ler mais</span>
            <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </article>
      @empty
      <article class="news-card reveal">
        <div class="news-thumb">
          <span class="news-cat" data-i18n="news.1.cat">Economia</span>
          <img src="{{ asset('assets/noticia-1.webp') }}" alt="" loading="lazy" onerror="this.closest('.news-thumb').classList.add('no-img')">
          <span class="nt-fallback"><span class="discs"><i></i><i></i><i></i></span><small>assets/noticia-1.webp</small></span>
        </div>
        <div class="news-body">
          <span class="news-date" data-i18n="news.1.data">12 Mai 2026</span>
          <h3 data-i18n="news.1.t">Setor privado guineense regista crescimento no primeiro trimestre</h3>
          <p data-i18n="news.1.r">Dados recentes apontam para uma recuperação sustentada nos serviços e no comércio.</p>
          <a href="#" class="news-read"><span data-i18n="news.read">Ler mais</span>
            <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cta-band">
  <div class="container cta-inner">
    <h2 data-i18n="cta.title">Transforme os seus desafios em oportunidades de crescimento.</h2>
    <a href="#contacto" class="btn btn-accent btn-lg" data-i18n="cta.btn">Solicitar uma consultoria</a>
  </div>
</section>

<!-- ===== CONTACTO ===== -->
<section class="section section-tint" id="contacto">
  <div class="container contact-grid">
    <div class="contact-info">
      <span class="eyebrow" data-i18n="sec.contact.eyebrow">Vamos conversar</span>
      <h2 data-i18n="sec.contact.title">Conte-nos o seu desafio</h2>
      <p data-i18n="sec.contact.desc">Respondemos em até 48 horas úteis. Prefere falar diretamente? Use os contactos abaixo.</p>

      <ul class="contact-points">
        <li>
          <span class="cp-ic"><svg viewBox="0 0 24 24"><path d="M12 21s7-6.3 7-11a7 7 0 0 0-14 0c0 4.7 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
          <div><strong data-i18n="ct.pin">Endereço</strong><span class="cp-txt">Bissau, Av. Dr. Koumba Yalá — Antula</span></div>
        </li>
        <li>
          <span class="cp-ic"><svg viewBox="0 0 24 24"><path d="M5 4h3l2 5-2 1a11 11 0 0 0 5 5l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/></svg></span>
          <div><strong data-i18n="ct.phone">Telefones</strong><span class="cp-txt">+245 966 164 555 · +245 956 965 050</span></div>
        </li>
        <li>
          <span class="cp-ic"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg></span>
          <div><strong data-i18n="ct.mail">Email</strong><span class="cp-txt">eureka@eurekaconsulting.com</span></div>
        </li>
        <li>
          <span class="cp-ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
          <div><strong data-i18n="ct.clock">Horário</strong><span class="cp-txt" data-i18n="ct.clockV">Seg – Sex · 08h00 às 17h30</span></div>
        </li>
      </ul>

      <div class="contact-chips">
        <a href="#" class="chip chip-wa">WhatsApp</a>
        <a href="#" class="chip">LinkedIn</a>
        <a href="#" class="chip">Facebook</a>
      </div>

      <div class="map-slot" role="img" aria-label="Mapa — Antula, Bissau">
        <span>assets · mapa Antula, Bissau</span>
      </div>
    </div>

    <div class="form-card">
      <form class="contact-form" id="contactForm" novalidate>
        <div class="field-row">
          <div class="field">
            <label for="f-nome" data-i18n-html="f.nome">Nome <span>*</span></label>
            <input type="text" id="f-nome" name="nome" required autocomplete="name">
            <small class="err" data-for="f-nome"></small>
          </div>
          <div class="field">
            <label for="f-empresa" data-i18n="f.empresa">Empresa</label>
            <input type="text" id="f-empresa" name="empresa" autocomplete="organization">
          </div>
        </div>
        <div class="field-row">
          <div class="field">
            <label for="f-email" data-i18n-html="f.email">Email <span>*</span></label>
            <input type="email" id="f-email" name="email" required autocomplete="email">
            <small class="err" data-for="f-email"></small>
          </div>
          <div class="field">
            <label for="f-tel" data-i18n="f.tel">Telefone</label>
            <input type="tel" id="f-tel" name="telefone" autocomplete="tel">
          </div>
        </div>
        <div class="field-row">
          <div class="field">
            <label for="f-assunto" data-i18n="f.assunto">Assunto</label>
            <input type="text" id="f-assunto" name="assunto">
          </div>
          <div class="field">
            <label for="f-servico" data-i18n="f.servico">Serviço de interesse</label>
            <select id="f-servico" name="servico">
              <option value="" data-i18n="f.servicoPh">Selecione…</option>
              @foreach($services as $service)
                <option value="{{ $service->title }}">{{ $service->title }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="field">
          <label for="f-mensagem" data-i18n-html="f.mensagem">Mensagem <span>*</span></label>
          <textarea id="f-mensagem" name="mensagem" rows="4" required></textarea>
          <small class="err" data-for="f-mensagem"></small>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitBtn">
          <span class="btn-label" data-i18n="f.submit">Enviar mensagem</span>
          <span class="btn-spinner" aria-hidden="true"></span>
        </button>
        <p class="form-feedback" id="formFeedback" role="status" aria-live="polite"></p>
      </form>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(() => {
  "use strict";

  /* ---------- Vagas & Formações (fetch ao backend) ---------- */
  const listaVagas = document.getElementById("listaVagas");
  const listaFormacoes = document.getElementById("listaFormacoes");
  const searchVagas = document.getElementById("searchVagas");
  const candPanel = document.getElementById("candidaturaPanel");
  const candVagaSelect = document.getElementById("candidatarVaga");
  let allVagas = [];
  let allFormacoes = [];
  let vagasLoaded = false;
  let tokenValue = "";
  const fmtData = d => {
    const p = String(d || "").split("-");
    return p.length === 3 ? `${p[2]}/${p[1]}/${p[0]}` : (d || "");
  };
  const esc = s => String(s ?? "").replace(/[&<>"']/g, c => ({ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;", "'":"&#39;" }[c]));
  const renderVagas = items => {
    if (!items.length) {
      listaVagas.innerHTML = `<div class="empty-state"><i class="fa-solid fa-inbox"></i>${_("vg.empty")}</div>`;
      return;
    }
    listaVagas.innerHTML = items.map(v => `
      <article class="vaga-card">
        <div class="vaga-card-body">
          <h3>${esc(v.titulo_vaga)}</h3>
          <div class="vaga-tags">
            <span class="vaga-tag">${esc(v.departamento || _("vg.geral"))}</span>
            <span class="vaga-tag">${esc(v.localizacao || _("vg.bissau"))}</span>
            <span class="vaga-tag">${esc(v.tipo_contrato || _("vg.recrutamento"))}</span>
          </div>
          <p class="vaga-desc">${esc(String(v.descricao_vaga || "").slice(0, 140))}</p>
          <div class="vaga-footer">
            <span class="vaga-prazo"><i class="fa-regular fa-calendar"></i>${_("vg.prazo")} ${fmtData(v.data_limite)}</span>
            <button type="button" class="btn-candidatar" data-vaga-id="${v.id}" data-vaga-titulo="${esc(v.titulo_vaga)}">
              ${_("vg.cand")} <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </article>`).join("");
  };
  const fmtHora = h => { const p = String(h || "").split(":"); return p.length >= 2 ? `${p[0]}:${p[1]}` : ""; };
  const renderFormacoes = items => {
    if (!items.length) {
      listaFormacoes.innerHTML = `<div class="empty-state"><i class="fa-solid fa-graduation-cap"></i>${_("frm.empty")}</div>`;
      return;
    }
    listaFormacoes.innerHTML = items.map(f => {
      const horario = (f.hora_inicio && f.hora_fim)
        ? `<li><i class="fa-solid fa-hourglass-half"></i><span><small>${_("frm.horario")}</small>${fmtHora(f.hora_inicio)} a ${fmtHora(f.hora_fim)}</span></li>`
        : "";
      return `
      <article class="formacao-card">
        <div class="formacao-top">
          <span class="formacao-icone"><i class="fa-solid fa-graduation-cap"></i></span>
          <span class="badge-status ${String(f.status).toLowerCase().includes("curso") ? "badge-em-curso" : "badge-planejada"}">${esc(f.status)}</span>
        </div>
        <h3>${esc(f.tema)}</h3>
        <ul class="formacao-info">
          <li><i class="fa-solid fa-building-columns"></i><span><small>${_("frm.entidade")}</small>${esc(f.entidade)}</span></li>
          <li><i class="fa-solid fa-calendar-days"></i><span><small>${_("frm.inicio")}</small>${fmtData(f.data_inicio)}</span></li>
          <li><i class="fa-solid fa-calendar-check"></i><span><small>${_("frm.fim")}</small>${fmtData(f.data_fim)}</span></li>
          ${horario}
          <li><i class="fa-solid fa-clock"></i><span><small>${_("frm.carga")}</small>${f.carga_horaria}h</span></li>
        </ul>
        <button type="button" class="btn-inscrever" data-tema="${esc(f.tema)}">${_("frm.inscrever")} <i class="fa-solid fa-arrow-right"></i></button>
      </article>`;
    }).join("");
  };
  const fillVagaSelect = () => {
    if (!candVagaSelect) return;
    candVagaSelect.innerHTML = `<option value="" disabled selected>${_("cand.vagaPh")}</option>` + allVagas.map(v =>
      `<option value="${v.id}">${esc(v.titulo_vaga)}</option>`).join("");
  };
  if (listaFormacoes) listaFormacoes.addEventListener("click", e => {
    const b = e.target.closest(".btn-inscrever");
    if (!b) return;
    const assunto = document.getElementById("f-assunto");
    if (assunto) assunto.value = _("frm.inscricao") + b.dataset.tema;
    const contacto = document.getElementById("contacto");
    if (contacto) contacto.scrollIntoView({ behavior: "smooth", block: "start" });
  });
  const openPanel = vagaId => {
    if (!candPanel || !candVagaSelect) return;
    if (vagaId) candVagaSelect.value = String(vagaId);
    candPanel.style.display = "block";
    candPanel.scrollIntoView({ behavior: "smooth", block: "start" });
  };
  const closePanel = () => { if (candPanel) candPanel.style.display = "none"; };

  if (listaVagas) listaVagas.addEventListener("click", e => {
    const b = e.target.closest(".btn-candidatar");
    if (b) openPanel(b.dataset.vagaId);
  });

  if (searchVagas) searchVagas.addEventListener("input", () => {
    const q = searchVagas.value.trim().toLowerCase();
    const filt = allVagas.filter(v => (v.titulo_vaga || "").toLowerCase().includes(q) || (v.departamento || "").toLowerCase().includes(q));
    renderVagas(filt);
  });

  const btnFechar = document.getElementById("btnFecharCandidatura");
  const btnCancelar = document.getElementById("btnCancelarCandidatura");
  if (btnFechar) btnFechar.addEventListener("click", closePanel);
  if (btnCancelar) btnCancelar.addEventListener("click", closePanel);

  fetch("/vagas-formacoes", { headers: { "Accept": "application/json" } })
    .then(r => r.json())
    .then(d => {
      allVagas = d.recrutamentos || [];
      allFormacoes = d.formacoes || [];
      vagasLoaded = true;
      renderVagas(allVagas);
      renderFormacoes(allFormacoes);
      tokenValue = d._token || "";
      fillVagaSelect();
    })
    .catch(() => {
      if (listaVagas) listaVagas.innerHTML = `<div class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i>${_("vg.errVagas")}</div>`;
      if (listaFormacoes) listaFormacoes.innerHTML = `<div class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i>${_("frm.errFormacoes")}</div>`;
    });

  const formCand = document.getElementById("candidaturaForm");
  const candFeedback = document.getElementById("candFeedback");
  if (formCand) {
    formCand.addEventListener("submit", e => {
      e.preventDefault();
      candFeedback.textContent = ""; candFeedback.className = "form-feedback";
      if (!candVagaSelect.value) {
        candFeedback.textContent = _("cand.errVaga");
        candFeedback.classList.add("bad");
        return;
      }
      const btn = formCand.querySelector("button[type='submit']");
      const txt = btn.innerHTML;
      btn.classList.add("loading"); btn.disabled = true;
      btn.innerHTML = `<span class="btn-spinner"></span> ${_("cand.sending")}`;
      fetch("/candidatar", { method: "POST", body: new FormData(formCand), headers: { "Accept": "application/json" } })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            candFeedback.textContent = res.message;
            candFeedback.classList.add("ok");
            formCand.reset();
            closePanel();
          } else {
            candFeedback.textContent = res.message || _("cand.errSend");
            candFeedback.classList.add("bad");
          }
        })
        .catch(() => { candFeedback.textContent = _("cand.errGeneric"); candFeedback.classList.add("bad"); })
        .finally(() => { btn.classList.remove("loading"); btn.disabled = false; btn.innerHTML = txt; });
    });
  }

  /* Re-render dinâmico ao trocar de idioma */
  window.afterLangChange = () => {
    if (vagasLoaded) { renderVagas(allVagas); renderFormacoes(allFormacoes); fillVagaSelect(); }
  };

  /* Formulário de contacto (simulação) */
  const form = document.getElementById("contactForm");
  if (form) {
    const feedback = document.getElementById("formFeedback");
    const submitBtn = document.getElementById("submitBtn");
    const setError = (input,msg) => {
      const f = input.closest(".field"); f.classList.toggle("invalid", !!msg);
      const e = f.querySelector(".err"); if (e) e.textContent = msg || "";
    };
    const validate = () => {
      let ok = true;
      if (!form.nome.value.trim()) { setError(form.nome,_("f.errNome")); ok=false; } else setError(form.nome,"");
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!form.email.value.trim()) { setError(form.email,_("f.errEmail")); ok=false; }
      else if (!re.test(form.email.value.trim())) { setError(form.email,_("f.errEmailInv")); ok=false; }
      else setError(form.email,"");
      if (!form.mensagem.value.trim()) { setError(form.mensagem,_("f.errMsg")); ok=false; } else setError(form.mensagem,"");
      return ok;
    };
    ["nome","email","mensagem"].forEach(n => form[n].addEventListener("input", () => {
      if (form[n].closest(".field").classList.contains("invalid")) validate();
    }));
    form.addEventListener("submit", e => {
      e.preventDefault();
      feedback.textContent = ""; feedback.className = "form-feedback";
      if (!validate()) { feedback.textContent = _("f.errTop"); feedback.classList.add("bad"); return; }
      submitBtn.classList.add("loading"); submitBtn.disabled = true;
      setTimeout(() => {
        submitBtn.classList.remove("loading"); submitBtn.disabled = false; form.reset();
        feedback.textContent = _("f.ok");
        feedback.classList.add("ok");
      }, 1300);
    });
  }
})();
</script>
@endpush
