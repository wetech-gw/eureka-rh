<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Financeiro extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'recrutamentos';

    protected $fillable = [
        'titulo',
        'descricao',
        'requisitos',
        'localizacao',
        'salario',
        'status'
    ];
}