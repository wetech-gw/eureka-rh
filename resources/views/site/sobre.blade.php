@extends('layouts.site')

@section('title', 'Sobre nós — Eureka Consulting')

@section('content')

<!-- ===== CABEÇALHO DA PÁGINA ===== -->
<section class="hero">
  <div class="container">
    <header class="section-head" style="margin-bottom:0">
      <span class="eyebrow">Sobre a Eureka</span>
      <h1>Uma parceira que entende o contexto empresarial africano</h1>
      <p>Nascida em Bissau, a Eureka Consulting cresceu ao ritmo das empresas que acompanha.</p>
    </header>
  </div>
</section>

<!-- ===== SOBRE ===== -->
<section class="section section-dark" id="sobre">
  <div class="container about-grid">
    <div class="about-main">
      @if($about)
        <span class="eyebrow eyebrow-light">Sobre a Eureka</span>
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
        <span class="eyebrow eyebrow-light">Sobre a Eureka</span>
        <h2>Uma parceira que entende o contexto empresarial africano</h2>
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
        <img src="{{ $about && $about->image_path ? asset('storage/' . $about->image_path) : asset('assets/sobre.webp') }}" alt="Escritório da Eureka Consulting em Bissau"
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

<!-- ===== HISTÓRIA ===== -->
<section class="section" id="historia">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow">O nosso percurso</span>
      <h2>Uma história de crescimento contínuo</h2>
    </header>
    <ol class="timeline">
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.1.meta">Os primeiros passos</p><h3 class="tl-phase" data-i18n="hist.1.fase">Criação</h3><p data-i18n="hist.1.d">A Eureka nasce em Bissau com a missão de aproximar consultoria de qualidade das empresas locais.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.2.meta">Consolidação</p><h3 class="tl-phase" data-i18n="hist.2.fase">Crescimento</h3><p data-i18n="hist.2.d">Alargamento da carteira de serviços e da equipa multidisciplinar.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.3.meta">Para além das fronteiras</p><h3 class="tl-phase" data-i18n="hist.3.fase">Expansão Africana</h3><p data-i18n="hist.3.d">Projetos e parcerias em vários países da África Ocidental.</p></li>
      <li class="tl-item reveal"><span class="tl-dot"></span><p class="tl-meta" data-i18n="hist.4.meta">O próximo capítulo</p><h3 class="tl-phase" data-i18n="hist.4.fase">Visão Futura</h3><p data-i18n="hist.4.d">Aceleração de empresas, inovação e ligação a redes internacionais de investimento.</p></li>
    </ol>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cta-band">
  <div class="container cta-inner">
    <h2>Vamos construir o próximo capítulo juntos.</h2>
    <a href="{{ route('site.inicio') }}#contacto" class="btn btn-accent btn-lg">Entrar em contacto</a>
  </div>
</section>

@endsection
