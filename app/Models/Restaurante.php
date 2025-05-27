<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurante extends Model
{
    // Laravel adivina 'restaurantes' como nombre de tabla, así que no hace falta protected $table

    protected $fillable = [
        'nombre',
        'direccion',
        'tipo',
        'rating',
        'imagen',
        'user_id',
        'lat',
        'lng',
    ];

    /**
     * Relación polimórfica a la tabla 'productos'
     * Con morphMany en Restaurante enlazamos cada restaurante con sus registros en productos usando 
     * productable_type = 'App\Models\Restaurante' y productable_id = restaurantes.id
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'restaurante_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
