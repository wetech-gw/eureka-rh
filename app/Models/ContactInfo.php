<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'address',
        'phones',
        'email',
        'schedule',
        'whatsapp',
        'linkedin',
        'facebook',
    ];
}
