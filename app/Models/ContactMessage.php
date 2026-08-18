<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'nome',
        'empresa',
        'email',
        'telefone',
        'assunto',
        'servico',
        'mensagem',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeNaoLidas($query)
    {
        return $query->whereNull('read_at');
    }
}
