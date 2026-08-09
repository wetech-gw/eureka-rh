@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Nova Estatística</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Adicionar um número ao hero da página inicial</p>
    </div>
    <a href="{{ route('admin.estatisticas.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 760px;">
    <form action="{{ route('admin.estatisticas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-medium">Valor <span class="text-danger">*</span></label>
            <input type="text" name="value" class="form-control" value="{{ old('value') }}" placeholder="Ex.: 10" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Sufixo</label>
            <input type="text" name="suffix" class="form-control" value="{{ old('suffix') }}" placeholder="Ex.: +">
            <small class="text-muted">Símbolo mostrado junto ao valor (ex.: <code>+</code>).</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Rótulo <span class="text-danger">*</span></label>
            <input type="text" name="label" class="form-control" value="{{ old('label') }}" placeholder="Ex.: anos de experiência" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Ordem de apresentação</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
            <small class="text-muted">Número menor aparece primeiro.</small>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.estatisticas.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
