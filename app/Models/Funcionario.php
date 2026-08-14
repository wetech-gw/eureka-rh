<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funcionario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'data_nascimento',
        'contacto',
        'empresa',
        'bi',
        'nif',
        'cargo',
        'estado',
        'tipo_contrato',
        'data_inicio_contrato',
        'data_fin_periodo_experiencia',
        'data_fin_contrato',
        'data_inscricao_inss',
        'num_seguranca_social',
        'num_conta_bancaria',
        'banco',
        'tipo_trabalhador',
        'salario_bruto',
    ];

    public function ferias(): HasMany
    {
        return $this->hasMany(Feria::class);
    }
}
