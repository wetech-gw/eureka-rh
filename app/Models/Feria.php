<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feria extends Model
{
    protected $fillable = [
        "funcionario_id",
        "tipo",
        "data_inicio",
        "data_fim",
        "dias",
        "justificativo",
        "estado_pedido",
        "observacoes"
        ];

        protected function casts(): array
            {
                return [
                    'data_inicio' => 'date',
                    'data_fim' => 'date',

                ];
            }

            /**
             * L'employé qui a effectué la demande.
             */
             public function funcionario(): BelongsTo
             {
                 return $this->belongsTo(Funcionario::class);
             }
}
