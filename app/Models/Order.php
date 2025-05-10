<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\ShippingDetail;  // <-- añade esta línea

class Order extends Model
{
    protected $fillable = ['user_id','total','shipping_cost','estado'];

    /**
     * Detalle de los ítems de la orden
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Detalle de envío / pago asociado a la orden
     */
    public function shippingDetail()
    {
        return $this->hasOne(ShippingDetail::class);
    }
}
