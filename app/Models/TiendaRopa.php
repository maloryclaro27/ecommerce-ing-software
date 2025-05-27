<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Producto; 

class TiendaRopa extends Model
{
    // Si tu tabla no sigue la convención plural automática:
    protected $table = 'ropa';

    // Campos asignables
    protected $fillable = [
        'nombre',
        'direccion',
        'rating',
        'imagen',
        'user_id',
        'lat',
        'lng',
    ];

    /**
     * Relación polimórfica a productos
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'ropa_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
