<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Restaurante;

class Producto extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'category_id',
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'restaurante_id',
        'drogueria_id',
        'ropa_id',
        'tecnologia_id'
    ];

    // Relación con dueño del producto (usuario)
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con restaurante (si aplica)
    public function restaurante(): BelongsTo
    {
        return $this->belongsTo(Restaurante::class, 'restaurante_id');
    }

    
    public function drogueria(): BelongsTo
    {
        return $this->belongsTo(Drogueria::class, 'drogueria_id');
    }

    public function ropa(): BelongsTo
    {
        return $this->belongsTo(TiendaRopa::class, 'ropa_id');
    }

    public function tecnologia(): BelongsTo
    {
        return $this->belongsTo(TiendaTecnologia::class, 'tecnologia_id');
    }
    public function category()
    {
        return $this->belongsTo(Catalogo::class, 'category_id');
    }
    
}
