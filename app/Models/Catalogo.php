<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    // Le decimos que la tabla se llama 'catalogo'
    protected $table = 'catalogo';

    // Columnas asignables
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
    ];
}

