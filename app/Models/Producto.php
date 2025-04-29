<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Producto extends Model
{
    // Si tu tabla no sigue pluralización automática, descomenta:
    // protected $table = 'productos';

    // Timestamps (created_at, updated_at)
    public $timestamps = true;

    // Campos asignables
    protected $fillable = [
        'productable_id',
        'productable_type',
        'nombre',
        'descripcion',
        'precio',
        'imagen',
    ];

    /**
     * Relación polimórfica al “dueño” del producto
     */
    public function productable(): MorphTo
    {
        return $this->morphTo();
    }
}

