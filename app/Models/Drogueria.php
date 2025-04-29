<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
class Drogueria extends Model
{
    // Si tu tabla no se llama exactamente 'droguerias', descomenta y ajusta:
    // protected $table = 'droguerias';

    protected $fillable = [
        'nombre',
        'rating',
        'imagen',
    ];

    public function productos(): MorphMany
    {
        return $this->morphMany(Producto::class, 'productable');
    }
}
