<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoostMe extends Model
{
    protected $fillable = ['eyebrow', 'title', 'image_path', 'description', 'features', 'cta1', 'cta2', 'cta3', 'is_active'];
}
