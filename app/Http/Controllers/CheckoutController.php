<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ShippingDetail;

class CheckoutController extends Controller
{
    /**
     * Paso 1: Crea la orden (con envío), sus order_items, vacía el carrito
     * y redirige al formulario de captura de envío/pago.
     */
    public function store(Request $request)
    {
        $user      = Auth::user();
        $cartItems = $user->cartItems()->with('producto')->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors('Tu carrito está vacío.');
        }

        // Calcula subtotal
        $subtotal = $cartItems->sum(fn($ci) => $ci->producto->precio * $ci->cantidad);

        // Envío = 10% del subtotal
        $shippingCost = round($subtotal * 0.10, 2);

        // Total antes de puntos (subtotal + envío)
        $totalBeforePoints = $subtotal + $shippingCost;

        // 1) Crear la orden con total provisional
        $order = $user->orders()->create([
            'total'         => $totalBeforePoints,
            'shipping_cost' => $shippingCost,
            'status'        => 'pending',
        ]);

        // 2) Crear los order_items
        foreach ($cartItems as $ci) {
            $order->items()->create([
                'producto_id'         => $ci->producto_id,
                'cantidad'            => $ci->cantidad,
                'precio_unitario'     => $ci->producto->precio,
                'establecimiento_id'  => $ci->establecimiento_id,
                'establecimiento_tipo'=> $ci->establecimiento_tipo,
            ]);
        }

        // 3) Vaciar el carrito
        $user->cartItems()->delete();

        // 4) Redirigir al formulario de envío/pago
        return redirect()->route('checkout.show', $order->id);
    }

    /**
     * Paso 2: Muestra el formulario para capturar dirección,
     * teléfono y método de pago, con datos de usuario precargados.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();
        return view('checkout', compact('order', 'user'));
    }

    /**
     * Paso 3: Valida y guarda los datos de envío, aplica puntos,
     * marca la orden como pagada, y redirige a la confirmación.
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
            'use_points'     => 'required|integer|min:0',
            'subtotal'       => 'required|numeric',
            'shipping_cost'  => 'required|numeric',
        ]);

        $user = Auth::user();

        // Determina puntos canjeables (múltiplos de 1000)
        $available    = $user->loyalty_points;
        $maxCanjeable = intdiv($available, 1000) * 1000;
        $usePoints    = min($data['use_points'], $maxCanjeable, $data['subtotal']);

        // Calcula total neto tras canje de puntos
        $netTotal = $data['subtotal'] + $data['shipping_cost'] - $usePoints;

        // 1) Guarda detalles de envío/pago
        $order->shippingDetail()->create([
            'direccion'      => $data['direccion'],
            'telefono'       => $data['telefono'],
            'payment_method' => $data['payment_method'],
        ]);

        // 2) Actualiza la orden
        $order->update([
            'status'        => 'paid',
            'total'         => $netTotal,
            'shipping_cost' => $data['shipping_cost'],
        ]);

        // 3) Ajusta puntos del usuario:
        //    resta los usados y suma los ganados (50puntos cada 1000 pagados)
        $earned = intdiv($netTotal, 1000) * 50;
        $user->loyalty_points = $available - $usePoints + $earned;
        $user->save();

        // 4) Guarda en sesión los puntos usados y ganados para mostrar
        session([
            'loyalty_used'   => $usePoints,
            'loyalty_earned' => $earned,
        ]);

        // 5) Redirige a la vista de pago realizado
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
