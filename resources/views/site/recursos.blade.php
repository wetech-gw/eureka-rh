@extends('layouts.site')

@section('title', 'Recursos — Eureka Consulting')

@section('content')

<!-- ===== CABEÇALHO DA PÁGINA ===== -->
<section class="hero">
  <div class="container">
    <header class="section-head" style="margin-bottom:0">
      <span class="eyebrow">Recursos para empreendedores</span>
      <h1>Instituições que apoiam quem constrói</h1>
      <p>Organizações de referência no financiamento e no apoio ao empreendedorismo na sub-região da África Ocidental.</p>
    </header>
  </div>
</section>

<!-- ===== RECURSOS ===== -->
<section class="section section-tint" id="recursos">
  <div class="container">
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
        <a href="{{ $resource->link ?: '#' }}" class="res-link" target="_blank" rel="noopener"><span>Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      @empty
      <article class="resource-card reveal">
        <div class="res-logo"><span>DER/FJ</span></div>
        <h3>DER/FJ</h3>
        <p data-i18n="res.1.d">Apoio ao desenvolvimento e financiamento de jovens empreendedores.</p>
        <a href="#" class="res-link" target="_blank" rel="noopener"><span>Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      <article class="resource-card reveal">
        <div class="res-logo"><span>BANC</span></div>
        <h3>Banco Central</h3>
        <p data-i18n="res.2.d">Regulação e políticas de financiamento à economia nacional.</p>
        <a href="#" class="res-link" target="_blank" rel="noopener"><span>Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cta-band">
  <div class="container cta-inner">
    <h2>Precisa de apoio para aceder a estes recursos?</h2>
    <a href="{{ route('site.inicio') }}#contacto" class="btn btn-accent btn-lg">Falar com um consultor</a>
  </div>
</section>

@endsection
