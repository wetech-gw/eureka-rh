@php
    $avisosFerias = $avisosFerias ?? [];
    $haEntrada = collect($avisosFerias)->contains('tipo', 'entrada');
    $haFim = collect($avisosFerias)->contains('tipo', 'fim');
@endphp

@if(count($avisosFerias) > 0)
<div class="mb-4">
    <span class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">Notificações de Férias</span>

    <div class="row g-2 mt-1">
    @foreach($avisosFerias as $aviso)
        @if($aviso['tipo'] === 'entrada')
            <div class="col-12 col-md-6">
                <div class="d-flex align-items-center gap-2 bg-light border border-warning-subtle rounded px-3 py-2 h-100" style="font-size: 13px;">
                    <span class="rounded-circle" style="width: 8px; height: 8px; background-color: #fd7e14; flex-shrink: 0;"></span>
                    <span class="fw-medium">
                        <strong class="text-dark">{{ $aviso['nome'] }}</strong>
                        @if($aviso['dias'] > 0)
                            deve entrar de férias
                            <span class="countdown-dias fw-bold text-warning" data-alvo="{{ $aviso['data_alvo'] }}" data-tipo="entrada">
                                em {{ $aviso['dias'] }} {{ $aviso['dias'] == 1 ? 'dia' : 'dias' }}
                            </span>
                        @elseif($aviso['dias'] === 0)
                            deve entrar de férias <span class="countdown-dias fw-bold text-warning" data-alvo="{{ $aviso['data_alvo'] }}" data-tipo="entrada">hoje!</span>
                        @else
                            tem férias em atraso
                            <span class="countdown-dias fw-bold text-danger" data-alvo="{{ $aviso['data_alvo'] }}" data-tipo="entrada">
                                há {{ abs($aviso['dias']) }} {{ abs($aviso['dias']) == 1 ? 'dia' : 'dias' }}
                            </span>
                        @endif
                        · {{ $aviso['dias_disponiveis'] }} {{ $aviso['dias_disponiveis'] == 1 ? 'dia disponível' : 'dias disponíveis' }}
                        ({{ $aviso['cargo'] }})
                    </span>
                </div>
            </div>
        @elseif($aviso['tipo'] === 'fim')
            <div class="col-12 col-md-6">
                <div class="d-flex align-items-center gap-2 bg-light border border-info-subtle rounded px-3 py-2 h-100" style="font-size: 13px;">
                    <span class="rounded-circle" style="width: 8px; height: 8px; background-color: #0dcaf0; flex-shrink: 0;"></span>
                    <span class="fw-medium">
                        As férias de <strong class="text-dark">{{ $aviso['nome'] }}</strong> terminam
                        <span class="countdown-dias fw-bold text-info" data-alvo="{{ $aviso['data_alvo'] }}" data-tipo="fim">
                            em {{ $aviso['dias'] }} {{ $aviso['dias'] == 1 ? 'dia' : 'dias' }}
                        </span>
                        ({{ $aviso['cargo'] }})
                    </span>
                </div>
            </div>
        @endif
    @endforeach
    </div>
</div>
@endif

<script>
(function() {
    const plural = n => n === 1 ? ' dia' : ' dias';
    const atualizar = () => {
        document.querySelectorAll('.countdown-dias').forEach(el => {
            const alvo = new Date(el.dataset.alvo + 'T00:00:00');
            const tipo = el.dataset.tipo;
            const hoje = new Date();
            hoje.setHours(0, 0, 0, 0);
            const diff = Math.round((alvo - hoje) / 86400000);
            if (tipo === 'fim') {
                el.textContent = diff > 0 ? 'em ' + diff + plural(diff) : (diff === 0 ? 'hoje!' : 'há ' + Math.abs(diff) + plural(Math.abs(diff)));
            } else if (diff > 0) {
                el.textContent = 'em ' + diff + plural(diff);
            } else if (diff === 0) {
                el.textContent = 'hoje!';
            } else {
                el.textContent = 'há ' + Math.abs(diff) + plural(Math.abs(diff));
            }
        });
    };
    document.addEventListener('DOMContentLoaded', atualizar);
    setInterval(atualizar, 3600000);
})();
</script>
