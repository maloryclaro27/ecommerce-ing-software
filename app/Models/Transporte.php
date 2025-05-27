<?php

// app/Models/Transporte.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class Transporte extends Model
{
    use HasFactory;

    protected $table = 'transportes';

    /**
     * Campos asignables en masa.
     */
    protected $fillable = [
        'tipo',                // dron, moto, bicicleta
        'estado',              // activo, ocupado, inactivo
        'nombre_domiciliario', // para moto/bici
        'lat',                 // latitud (drones)
        'lng',                 // longitud (drones)
    ];

    /**
     * Pedidos asociados a este medio de transporte.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}