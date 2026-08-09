@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Novo Registo BOOST_ME</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Adicionar conteúdo à secção BOOST_ME do site</p>
    </div>
    <a href="{{ route('admin.boost.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 760px;">
    <form action="{{ route('admin.boost.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-medium">Eyebrow / Subtítulo</label>
            <input type="text" name="eyebrow" class="form-control" value="{{ old('eyebrow') }}" placeholder="Ex.: Programa de aceleração">
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder='Ex.: <span class="boost-name">BOOST_ME</span><br>Acelerador de Empresas'>
            <small class="text-muted">Pode incluir HTML. Deixar vazio para usar o predefinido.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Imagem</label>
            <input type="file" name="image_path" class="form-control" accept="image/png,image/jpeg,image/webp">
            <small class="text-muted">PNG, JPG ou WEBP (máx. 4 MB). Mostrada ao lado da secção no site.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Descrição <span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Características (uma por linha)</label>
            <textarea name="features" class="form-control" rows="3" placeholder="Diagnóstico e estruturação do negócio&#10;Mentoria estratégica personalizada">{{ old('features') }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">CTA 1</label>
                <input type="text" name="cta1" class="form-control" value="{{ old('cta1') }}" placeholder="Ex.: Conhecer o programa">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">CTA 2</label>
                <input type="text" name="cta2" class="form-control" value="{{ old('cta2') }}" placeholder="Ex.: Candidatar-se">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">CTA 3</label>
                <input type="text" name="cta3" class="form-control" value="{{ old('cta3') }}" placeholder="Ex.: Solicitar informações">
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Ativo (mostrar no site)</label>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.boost.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
