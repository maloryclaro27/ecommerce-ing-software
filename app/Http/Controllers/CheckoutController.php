<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ShippingDetail;

class CheckoutController extends Controller
{
    /**
     * Paso 1: Crear la orden (con envío), sus order_items,
     * vaciar el carrito y redirigir al formulario de captura.
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

        // Total provisional (subtotal + envío)
        $totalBefore = $subtotal + $shippingCost;

        // 1) Crear la orden con total provisional y estado inicial
        $order = $user->orders()->create([
            'total'         => $totalBefore,
            'shipping_cost' => $shippingCost,
            'estado'        => 'pending',
        ]);

        // 2) Crear los order_items usando el campo polymorphic existente
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
     * Paso 2: Mostrar el formulario para capturar dirección,
     * teléfono y método de pago.
     */
    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        return view('checkout', [
            'order' => $order,
            'user'  => Auth::user(),
        ]);
    }

    /**
     * Paso 3: Validar y guardar datos de envío/pago,
     * usar coordenadas fijas desde configuración,
     * aplicar puntos, marcar como pagada y redirigir.
     */
    public function process(Request $request, Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        $data = $request->validate([
            'telefono'       => 'required|string|max:20',
            'use_points'     => 'required|integer|min:0',
            'subtotal'       => 'required|numeric',
            'shipping_cost'  => 'required|numeric',
        ]);

        $user      = Auth::user();
        $available = $user->loyalty_points;
        $maxCanje  = intdiv($available, 1000) * 1000;
        $usePoints = min($data['use_points'], $maxCanje, $data['subtotal']);
        $netTotal  = $data['subtotal'] + $data['shipping_cost'] - $usePoints;

        // 1) Crear ShippingDetail con valores fijos
        $shipping = $order->shippingDetail()->create([
            'direccion'      => config('delivery.delivery_address'),
            'telefono'       => $data['telefono'],
            'payment_method' => 'tarjeta',
            'lat'            => config('delivery.delivery_lat'),
            'lng'            => config('delivery.delivery_lng'),
        ]);

        // 2) Actualizar la orden: total y estado
        $order->update([
            'total'         => $netTotal,
            'shipping_cost' => $data['shipping_cost'],
            'estado'        => 'paid',
        ]);

        // 3) Ajustar puntos del usuario
        $earned               = intdiv($netTotal, 1000) * 50;
        $user->loyalty_points = $available - $usePoints + $earned;
        $user->save();

        // 4) Guardar en sesión los puntos usados y ganados
        session([
            'loyalty_used'   => $usePoints,
            'loyalty_earned' => $earned,
        ]);

        // 5) Redirigir a la confirmación de pago
        return redirect()->route('checkout.done', $order->id);
    }

    /**
     * Paso 4: Mostrar la página de confirmación de pago.
     */
    public function done(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        return view('pago_realizado', compact('order'));
    }
}
