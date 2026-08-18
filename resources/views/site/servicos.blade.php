@extends('layouts.site')

@section('title', 'Serviços — Eureka Consulting')

@section('content')

<!-- ===== CABEÇALHO DA PÁGINA ===== -->
<section class="hero">
  <div class="container">
    <header class="section-head" style="margin-bottom:0">
      <span class="eyebrow">O que fazemos</span>
      <h1>As nossas àreas de intervenção</h1>
      <p>Competências multidisciplinares para cada fase do percurso empresarial, desenhadas para o contexto da Guiné-Bissau e da África Ocidental.</p>
    </header>
  </div>
</section>

<!-- ===== SERVIÇOS ===== -->
<section class="section section-tint" id="servicos">
  <div class="container">
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
        <a href="{{ route('site.inicio') }}#contacto" class="svc-more"><span>Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      @empty
      <article class="service-card reveal">
        <div class="svc-icon"><i class="fa-solid fa-briefcase"></i></div>
        <h3 data-i18n="svc.consultoria.t">Consultoria</h3>
        <p data-i18n="svc.consultoria.d">Aconselhamento estratégico transversal para decisões empresariais mais seguras.</p>
        <a href="{{ route('site.inicio') }}#contacto" class="svc-more"><span>Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      <article class="service-card reveal">
        <div class="svc-icon"><i class="fa-solid fa-chart-line"></i></div>
        <h3 data-i18n="svc.gestao.t">Gestão e Estratégia</h3>
        <p data-i18n="svc.gestao.d">Estruturação, planeamento e otimização de operações orientadas a resultados.</p>
        <a href="{{ route('site.inicio') }}#contacto" class="svc-more"><span>Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      <article class="service-card reveal">
        <div class="svc-icon"><i class="fa-solid fa-handshake"></i></div>
        <h3 data-i18n="svc.capacitacao.t">Capacitação</h3>
        <p data-i18n="svc.capacitacao.d">Formações práticas para equipas e líderes em finanças, gestão e liderança.</p>
        <a href="{{ route('site.inicio') }}#contacto" class="svc-more"><span>Saber mais</span>
          <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== VALORES ===== -->
<section class="section" id="valores">
  <div class="container">
    <header class="section-head">
      <span class="eyebrow">O que nos guia</span>
      <h2>Valores que sustentam cada projeto</h2>
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

<!-- ===== CTA ===== -->
<section class="cta-band">
  <div class="container cta-inner">
    <h2>Transforme os seus desafios em oportunidades de crescimento.</h2>
    <a href="{{ route('site.inicio') }}#contacto" class="btn btn-accent btn-lg">Solicitar uma consultoria</a>
  </div>
</section>

@endsection
