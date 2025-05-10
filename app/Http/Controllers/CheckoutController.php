<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ShippingDetail;

class CheckoutController extends Controller
{
    /**
     * Paso 1: Crea la orden y sus order_items, vacía el carrito,
     * y redirige al formulario de datos de envío.
     */
    public function store()
    {
        $user      = Auth::user();
        $cartItems = $user->cartItems()->with('producto')->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors('Tu carrito está vacío.');
        }

        // Calcula el total
        $total = $cartItems->sum(fn($ci) => $ci->producto->precio * $ci->cantidad);

        // 1) Crea la orden
        $order = $user->orders()->create([
            'total'  => $total,
            'status' => 'pending',
        ]);

        // 2) Crea los order_items
        foreach ($cartItems as $ci) {
            $order->items()->create([
                'producto_id'         => $ci->producto_id,
                'cantidad'            => $ci->cantidad,
                'precio_unitario'     => $ci->producto->precio,
                'establecimiento_id'  => $ci->establecimiento_id,
                'establecimiento_tipo'=> $ci->establecimiento_tipo,
            ]);
        }

        // 3) Vacía el carrito
        $user->cartItems()->delete();

        // 4) Redirige al formulario de envío/pago
        return redirect()->route('checkout.show', $order->id);
    }

    /**
     * Paso 2: Muestra el formulario para capturar dirección,
     * teléfono y método de pago.
     */
    public function show(Order $order)
    {
        // Opcional: verifica que el usuario sea dueño de la orden
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();
        return view('checkout', compact('order', 'user'));
    }

    /**
     * Paso 3: Valida y guarda los datos de envío, marca la orden
     * como pagada, y redirige a la confirmación.
     */
    public function process(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'direccion'      => 'required|string|max:255',
            'telefono'       => 'required|string|max:20',
            'payment_method' => 'required|in:tarjeta,transferencia,contraentrega',
        ]);

        // Guarda los detalles de envío/pago
        $order->shippingDetail()->create($data);

        // Marca la orden como pagada
        $order->update(['status' => 'paid']);

        return redirect()->route('checkout.done', $order->id);
    }

    /**
     * Paso 4: Muestra la página de confirmación de pago.
     */
    public function done(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pago_realizado', compact('order'));
    }
}
