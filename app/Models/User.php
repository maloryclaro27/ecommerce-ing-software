<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Producto;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    public const CREATED_AT = 'creado_en';
    public const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'nombre',
        'correo_electronico',
        'contrasena',
        'identificacion',
        'fecha_verificacion_correo',
        'token_recordarme',
        'loyalty_points',
        'telefono',
        'direccion',
        'rol',
        'categoria_negocio',
        'nombre_negocio',
    ];

    protected $hidden = [
        'contrasena',
        'token_recordarme',
    ];

    protected $casts = [
        'fecha_verificacion_correo' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getRememberTokenName()
    {
        return 'token_recordarme';
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // 🆕 Relación con productos del negocio
    public function productos()
    {
        return $this->hasMany(Producto::class, 'user_id');
    }
}
