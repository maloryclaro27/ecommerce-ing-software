<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TiendaTecnologia extends Model
{
    // Si tu tabla no sigue la convención plural automática:
    protected $table = 'tecnologia';

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
        return $this->hasMany(Producto::class, 'tecnologia_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
