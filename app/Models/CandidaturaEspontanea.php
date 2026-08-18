<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidaturaEspontanea extends Model
{
    protected $table = 'candidaturas_espontaneas';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'profissao',
        'nivel_academico',
        'anos_experiencia',
        'competencias',
        'localizacao',
        'cv_arquivo',
        'carta_motivacao_arquivo',
        'status',
    ];
}
