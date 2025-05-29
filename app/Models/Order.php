<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use App\Models\Transporte;

class Order extends Model
{
    /**
     * Campos asignables en masa.
     */
    protected $fillable = [
        'user_id',
        'total',
        'subtotal',           // si lo guardas en orders
        'shipping_cost',
        'payment_method',     // si prefieres guardarlo aquí
        'estado',             // estado de pago o procesamiento interno
        'transporte_id',
        'establecimiento_id',  // <— nuevo
        'establecimiento_tipo',// <— nuevo
        'estado_entrega',     // preparación, en_curso, entregado
    ];

    /**
     * Ítems incluidos en la orden.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Detalle de envío (dirección, etc.).
     */
    public function shippingDetail()
    {
        return $this->hasOne(ShippingDetail::class);
    }

    /**
     * Medio de transporte asignado.
     */
    public function transporte(): BelongsTo
    {
        return $this->belongsTo(Transporte::class);
    }
}
