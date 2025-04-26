<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    // Opcional, sólo si tu tabla no sigue la convención plural:
    // protected $table = 'restaurantes';

    protected $fillable = [
        'nombre',
        'tipo',
        'rating',
        'imagen',
    ];
}

