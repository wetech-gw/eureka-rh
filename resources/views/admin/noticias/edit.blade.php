@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Editar Notícia</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Alterar a notícia publicada</p>
    </div>
    <a href="{{ route('admin.noticias.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 860px;">
    <form action="{{ route('admin.noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $noticia->title) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Categoria <span class="text-danger">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $noticia->category) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Conteúdo <span class="text-danger">*</span></label>
            <textarea name="content" class="form-control" rows="6" required>{{ old('content', $noticia->content) }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Data de publicação <span class="text-danger">*</span></label>
                <input type="date" name="published_at" class="form-control" value="{{ old('published_at', $noticia->published_at ? $noticia->published_at->format('Y-m-d') : '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Imagem</label>
                @if($noticia->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $noticia->image_path) }}" alt="" style="max-width: 160px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" name="image_path" class="form-control" accept="image/jpeg,image/png">
                <small class="text-muted">Deixe vazio para manter a imagem atual.</small>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
