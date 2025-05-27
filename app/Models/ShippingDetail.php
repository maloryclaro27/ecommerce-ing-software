<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $fillable = [
      'order_id',
      'direccion',
      'telefono',
      'payment_method',
      'lat',
      'lng',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}