@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Criar Contactos</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Configurar os dados da secção de contacto do site</p>
    </div>
    <a href="{{ route('admin.contactos.index') }}" class="btn btn-light bg-white border px-3 py-2 text-secondary fw-medium rounded-3" style="font-size: 13px; text-decoration: none; height: 38px; display: flex; align-items: center;">
        ← Voltar
    </a>
</div>

<div class="card-custom shadow-sm bg-white p-4" style="max-width: 860px;">
    <form action="{{ route('admin.contactos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-medium">Endereço</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Bissau, Av. Dr. Koumba Yalá — Antula">
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Telefones</label>
                <input type="text" name="phones" class="form-control" value="{{ old('phones') }}" placeholder="+245 966 164 555 · +245 956 965 050">
                <small class="text-muted">Separe vários números com · (ponto médio).</small>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="eureka@eurekaconsulting.com">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium">Horário</label>
            <input type="text" name="schedule" class="form-control" value="{{ old('schedule') }}" placeholder="Seg – Sex · 08h00 às 17h30">
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">WhatsApp</label>
                <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="https://wa.me/...">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">LinkedIn</label>
                <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/...">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Facebook</label>
                <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}" placeholder="https://facebook.com/...">
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.contactos.index') }}" class="btn btn-light border rounded-3">Cancelar</a>
            <button type="submit" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Guardar</button>
        </div>
    </form>
</div>
@endsection
