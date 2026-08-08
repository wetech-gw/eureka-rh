@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Nova Página Sobre</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Adicionar conteúdo à secção "Sobre nós"</p>
    </div>
    <a href="{{ route('admin.sobre.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 860px;">
    <form action="{{ route('admin.sobre.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Descrição <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Missão</label>
                <textarea name="mission" class="form-control" rows="3">{{ old('mission') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Visão</label>
                <textarea name="vision" class="form-control" rows="3">{{ old('vision') }}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Imagem</label>
            <input type="file" name="image_path" class="form-control" accept="image/jpeg,image/png">
            <small class="text-muted">Se não carregar imagem, é usada a imagem predefinida do site.</small>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.sobre.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
