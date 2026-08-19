@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Notícias</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — gestão de notícias e perspetivas de mercado</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        @if(Auth::user()->role !== 'CEO')
        <a href="{{ route('admin.noticias.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Nova Notícia
        </a>
        @endif
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">Imagem</th>
                    <th class="pb-3">Título</th>
                    <th class="pb-3">Categoria</th>
                    <th class="pb-3">Publicado em</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($noticias as $noticia)
                    <tr class="border-bottom">
                        <td class="py-3">
                            @if($noticia->image_path)
                                <img src="{{ asset('storage/' . $noticia->image_path) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark" style="max-width: 320px;">{{ Str::limit($noticia->title, 70) }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge px-3 py-1.5 rounded-5 fw-medium" style="background-color: #f0fdfa; color: #0d9488;">{{ $noticia->category }}</span>
                        </td>
                        <td class="py-3 text-secondary">{{ $noticia->published_at ? $noticia->published_at->format('d M Y') : '—' }}</td>
                        <td class="py-3 text-end">
                            @if(Auth::user()->role !== 'CEO')
                            <a href="{{ route('admin.noticias.edit', $noticia) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.noticias.destroy', $noticia) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar esta notícia?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Ainda não existem notícias publicadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
