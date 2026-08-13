@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Nova Notícia</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Publicar uma notícia no site</p>
    </div>
    <a href="{{ route('admin.noticias.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 860px;">
    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Categoria <span class="text-danger">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="Economia" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Conteúdo <span class="text-danger">*</span></label>
            <textarea name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Data de publicação <span class="text-danger">*</span></label>
                <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Imagem</label>
 <input type="file" name="image_path" class="form-control" accept="image/jpeg,image/png,image/webp,image/avif">
 <small class="text-muted">JPG, PNG, WEBP ou AVIF (até 10 MB). Se não carregar imagem, é usada a imagem predefinida.</small>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Publicar</button>
        </div>
    </form>
</div>
@endsection
