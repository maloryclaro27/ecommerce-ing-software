<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Order;

class OrderItem extends Model
{
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'order_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'establecimiento_id',
        'establecimiento_tipo',
    ];

    /**
     * Relación con el producto asociado
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    /**
     * Relación con la orden padre
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
