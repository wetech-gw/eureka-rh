@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Novo Serviço</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Adicionar um serviço ao site</p>
    </div>
    <a href="{{ route('admin.servicos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 760px;">
    <form action="{{ route('admin.servicos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Descrição <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Ícone</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="fa-solid fa-briefcase">
            <small class="text-muted">Classe FontAwesome (ex.: <code>fa-solid fa-chart-line</code>) ou código SVG completo.</small>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Serviço em destaque</label>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.servicos.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
