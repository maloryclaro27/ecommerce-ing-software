<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CartItem;


class User extends Authenticatable
{
    use Notifiable;

    // Si tu tabla se llama "usuarios"
    protected $table = 'usuarios';

    // Renombrar columnas de timestamps
    public const CREATED_AT = 'creado_en';
    public const UPDATED_AT = 'actualizado_en';

    // Campos que pueden asignarse masivamente
    protected $fillable = [
        'nombre',
        'correo_electronico',
        'contrasena',
        'identificacion',
        'fecha_verificacion_correo',
        'token_recordarme',
        'loyalty_points',
    ];

    // Campos que no deben verse en arrays o JSON
    protected $hidden = [
        'contrasena',
        'token_recordarme',
    ];

    // Definir casts para fechas
    protected $casts = [
        'fecha_verificacion_correo' => 'datetime',
    ];

    /**
     * Laravel espera el campo "password" para la autenticación;
     * aquí le indicamos que use "contrasena".
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * Para que el "remember me" use tu columna "token_recordarme"
     */
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

}
