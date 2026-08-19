@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Contactos do Site</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Gestão do endereço, telefones, email e horário da secção de contacto</p>
    </div>
    @if(Auth::user()->role !== 'CEO')
        @if($contact)
            <a href="{{ route('admin.contactos.edit', $contact) }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
                Editar Contactos
            </a>
        @else
            <a href="{{ route('admin.contactos.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
                + Criar Contactos
            </a>
        @endif
    @endif
</div>

@if($contact)
<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">Campo</th>
                    <th class="pb-3">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">Endereço</td>
                    <td class="py-3 text-secondary">{{ $contact->address ?: '—' }}</td>
                </tr>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">Telefones</td>
                    <td class="py-3 text-secondary">{{ $contact->phones ?: '—' }}</td>
                </tr>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">Email</td>
                    <td class="py-3 text-secondary">{{ $contact->email ?: '—' }}</td>
                </tr>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">Horário</td>
                    <td class="py-3 text-secondary">{{ $contact->schedule ?: '—' }}</td>
                </tr>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">WhatsApp</td>
                    <td class="py-3 text-secondary">{{ $contact->whatsapp ?: '—' }}</td>
                </tr>
                <tr class="border-bottom">
                    <td class="py-3 fw-medium text-dark">LinkedIn</td>
                    <td class="py-3 text-secondary">{{ $contact->linkedin ?: '—' }}</td>
                </tr>
                <tr>
                    <td class="py-3 fw-medium text-dark">Facebook</td>
                    <td class="py-3 text-secondary">{{ $contact->facebook ?: '—' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @if(Auth::user()->role !== 'CEO')
    <div class="d-flex gap-2 mt-4">
        <a href="{{ route('admin.contactos.edit', $contact) }}" class="btn text-white px-4 rounded-3" style="background-color: var(--accent);">Editar</a>
        <form action="{{ route('admin.contactos.destroy', $contact) }}" method="POST" onsubmit="return confirm('Eliminar os contactos? O site voltará aos valores de origem.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger rounded-3">Eliminar</button>
        </form>
    </div>
    @endif
</div>
@else
<div class="card-custom shadow-sm bg-white p-5 text-center">
    <p class="text-muted mb-0">Ainda não existem contactos configurados. Clique em "+ Criar Contactos" para adicionar.</p>
</div>
@endif
@endsection
