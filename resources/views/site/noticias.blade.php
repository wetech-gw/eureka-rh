@extends('layouts.site')

@section('title', 'Notícias — Eureka Consulting')

@section('content')

<!-- ===== CABEÇALHO DA PÁGINA ===== -->
<section class="hero">
  <div class="container">
    <header class="section-head" style="margin-bottom:0">
      <span class="eyebrow">Atualidade</span>
      <h1>Notícias e perspetivas de mercado</h1>
      <p>Análises sobre economia, negócios e empreendedorismo na Guiné-Bissau e na região da África Ocidental.</p>
    </header>
  </div>
</section>

<!-- ===== NOTÍCIAS ===== -->
<section class="section section-tint" id="noticias">
  <div class="container">
    <div class="news-grid">
      @forelse($news as $new)
      <article class="news-card reveal" id="noticia-{{ $new->id }}">
        <div class="news-thumb">
          <span class="news-cat">{{ $new->category }}</span>
          <img src="{{ $new->image_path ? asset('storage/' . $new->image_path) : asset('assets/noticia-1.webp') }}" alt="{{ $new->title }}" loading="lazy"
               onerror="this.closest('.news-thumb').classList.add('no-img')">
          <span class="nt-fallback"><span class="discs"><i></i><i></i><i></i></span><small>{{ $new->category }}</small></span>
        </div>
        <div class="news-body">
          <span class="news-date">{{ $new->published_at ? $new->published_at->format('d M Y') : '' }}</span>
          <h3>{{ $new->title }}</h3>
          <p>{{ \Illuminate\Support\Str::limit($new->content, 160) }}</p>
          <a href="#noticia-{{ $new->id }}" class="news-read"><span>Ler artigo completo</span>
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
          <a href="#" class="news-read"><span>Ler mais</span>
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
    <h2>Acompanhe as nossas análises e insights de mercado.</h2>
    <a href="{{ route('site.inicio') }}#contacto" class="btn btn-accent btn-lg">Falar connosco</a>
  </div>
</section>

@endsection
