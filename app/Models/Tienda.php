<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    // La tabla en BD se llama 'ropa'
    protected $table = 'ropa';

    // Columnas que puedes asignar masivamente
    protected $fillable = [
        'nombre',
        'rating',
        'imagen',
    ];
}
