@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Editar Secção Início</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Alterar o conteúdo do hero da página inicial</p>
    </div>
    <a href="{{ route('admin.inicio.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 760px;">
    <form action="{{ route('admin.inicio.update', $inicio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $inicio->title) }}" required>
            <small class="text-muted">Pode incluir HTML, ex.: <code>&lt;span class="ink-accent"&gt;crescem&lt;/span&gt;</code></small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Subtítulo / Eyebrow</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $inicio->subtitle) }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Imagem (hero)</label>
            @if($inicio->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $inicio->image_path) }}" alt="" style="max-width: 200px; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="image_path" class="form-control" accept="image/jpeg,image/png,image/svg+xml">
            <small class="text-muted">Deixe vazio para manter a imagem atual.</small>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.inicio.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
