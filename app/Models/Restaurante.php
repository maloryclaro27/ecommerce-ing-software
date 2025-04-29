<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Restaurante extends Model
{
    // Laravel adivina 'restaurantes' como nombre de tabla, así que no hace falta protected $table

    protected $fillable = [
        'nombre',
        'tipo',
        'rating',
        'imagen',
    ];

    /**
     * Relación polimórfica a la tabla 'productos'
     * Con morphMany en Restaurante enlazamos cada restaurante con sus registros en productos usando 
     * productable_type = 'App\Models\Restaurante' y productable_id = restaurantes.id
     */
    public function productos(): MorphMany
    {
        return $this->morphMany(Producto::class, 'productable');
    }
}
