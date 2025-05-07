<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    // Si tu tabla no sigue pluralización automática, descomenta:
    // protected $table = 'productos';

    // Timestamps (created_at, updated_at)
    public $timestamps = true;

    // Campos asignables
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'restaurante_id',
        'drogueria_id',
        'ropa_id',
        'tecnologia_id'
    ];

    /**
     * Relación polimórfica al “dueño” del producto
     */
    public function restaurante(): BelongsTo
    {
        return $this->belongsTo(Restaurante::class, 'restaurante_id');
    }
}

