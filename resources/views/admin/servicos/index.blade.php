@extends('layouts.admin')

@section('page')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="font-serif display-6 fw-normal mb-1">Serviços</h1>
        <p class="text-accent fw-normal mb-0" style="font-size: 15px;">Eureka Consulting — gestão dos serviços apresentados no site</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.servicos.create') }}" class="btn text-white px-3 py-2 fw-medium rounded-3 d-flex align-items-center" style="background-color: var(--accent); font-size: 13px; text-decoration: none; height: 38px;">
            + Novo Serviço
        </a>
    </div>
</div>

<div class="card-custom shadow-sm bg-white p-4">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom text-muted small text-uppercase" style="font-size: 11px;">
                    <th class="pb-3">Ícone</th>
                    <th class="pb-3">Título</th>
                    <th class="pb-3">Descrição</th>
                    <th class="pb-3">Destaque</th>
                    <th class="pb-3 text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="border-bottom">
                        <td class="py-3">
                            @if($service->icon && Str::contains($service->icon, '<'))
                                <span style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; background: #f0fdfa; border-radius: 10px; color: #0d9488;">
                                    {!! $service->icon !!}
                                </span>
                            @else
                                <span style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; background: #f0fdfa; border-radius: 10px; color: #0d9488;">
                                    <i class="{{ $service->icon ?: 'fa-solid fa-briefcase' }}"></i>
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="fw-bold text-dark">{{ $service->title }}</div>
                        </td>
                        <td class="py-3 text-secondary" style="max-width: 320px;">{{ Str::limit($service->description, 90) }}</td>
                        <td class="py-3">
                            @if($service->is_featured)
                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-warning" style="background-color: #fff8e1; color: #b78103 !important;">Destaque</span>
                            @else
                                <span class="badge px-3 py-1.5 rounded-5 fw-medium text-secondary" style="background-color: #f1f3f5; color: #495057;">Normal</span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            <a href="{{ route('admin.servicos.edit', $service) }}" class="btn btn-sm btn-outline-secondary rounded-3">Editar</a>
                            <form action="{{ route('admin.servicos.destroy', $service) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Eliminar este serviço?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Ainda não existem serviços registados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
