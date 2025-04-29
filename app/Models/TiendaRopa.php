<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Producto; 

class TiendaRopa extends Model
{
    // Si tu tabla no sigue la convención plural automática:
    protected $table = 'ropa';

    // Campos asignables
    protected $fillable = [
        'nombre',
        'rating',
        'imagen',
    ];

    /**
     * Relación polimórfica a productos
     */
    public function productos(): MorphMany
    {
        return $this->morphMany(Producto::class, 'productable');
    }
}
