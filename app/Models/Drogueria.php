<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drogueria extends Model
{
    // Si tu tabla no se llama exactamente 'droguerias', descomenta y ajusta:
    // protected $table = 'droguerias';

    protected $fillable = [
        'nombre',
        'rating',
        'imagen',
    ];
}
