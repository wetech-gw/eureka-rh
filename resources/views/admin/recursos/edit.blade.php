@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Editar Recurso</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Alterar os dados da instituição</p>
    </div>
    <a href="{{ route('admin.recursos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 760px;">
    <form action="{{ route('admin.recursos.update', $recurso) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-medium">Nome <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $recurso->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Descrição <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $recurso->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Link (site)</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $recurso->link) }}" placeholder="https://...">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Logótipo</label>
            @if($recurso->logo_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $recurso->logo_path) }}" alt="" style="max-height: 60px; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="logo_path" class="form-control" accept="image/jpeg,image/png,image/svg+xml">
            <small class="text-muted">Deixe vazio para manter o logótipo atual.</small>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.recursos.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
