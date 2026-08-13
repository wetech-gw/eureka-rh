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
<section class="section section-tint resources-page" id="recursos">
  <div class="container">
    <div class="resources-grid">
      @forelse($resources as $resource)
      <article class="resource-card reveal">
        <div class="res-logo">
          @if($resource->logo_path)
            <img src="{{ asset('storage/' . $resource->logo_path) }}" alt="Recurso" onerror="this.closest('.res-logo').innerHTML='<span>R</span>'">
          @else
            <span>R</span>
          @endif
        </div>
        <a href="{{ $resource->link ?: '#' }}" class="res-link" target="_blank" rel="noopener"><span>Visitar site</span>
          <svg viewBox="0 0 24 24"><path d="M14 5h5v5M19 5l-8 8M11 5H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"/></svg>
        </a>
      </article>
      @empty
      <article class="resource-card reveal">
        <div class="res-logo"><span>R</span></div>
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
