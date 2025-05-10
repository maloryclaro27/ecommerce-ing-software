<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PuntosController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Sumar todos los pedidos completados
        $totalComprado = Order::where('user_id', $user->id)
                              ->where('estado', 'completado') // o como estés marcando los pedidos completados
                              ->sum('total');

        // Calcular puntos
        $puntos = floor($totalComprado / 10000);

        return view('puntos', compact('puntos'));
    }
}
