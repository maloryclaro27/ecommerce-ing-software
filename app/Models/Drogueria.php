<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Drogueria extends Model
{
    // Si tu tabla no se llama exactamente 'droguerias', descomenta y ajusta:
    // protected $table = 'droguerias';

    protected $fillable = [
        'nombre',
        'direccion',
        'rating',
        'imagen',
        'user_id',
        'lat',
        'lng',
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'drogueria_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
