<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $table = 'financeiros';

    protected $fillable = [
        'descricao',
        'tipo',
        'valor',
        'data_operacao',
        'categoria',
        'metodo_pagamento'
    ];
}