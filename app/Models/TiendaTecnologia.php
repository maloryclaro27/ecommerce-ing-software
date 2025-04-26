<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiendaTecnologia extends Model
{
    // Si tu tabla en BD se llama 'tecnologia'
    protected $table = 'tecnologia';

    // Columnas asignables
    protected $fillable = [
        'nombre',
        'rating',
        'imagen',
    ];
}
