<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PedidoController extends Controller
{
    public function historial()
    {
        $pedidos = Order::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('historial_pedidos', compact('pedidos'));
    }
}
