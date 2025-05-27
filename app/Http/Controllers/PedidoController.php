<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Transporte;

class PedidoController extends Controller
{
    /**
     * Historial de pedidos del usuario autenticado.
     */
    public function historial()
    {
        $pedidos = Order::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('historial_pedidos', compact('pedidos'));
    }

    /**
     * Muestra la selección de transportes disponibles para un pedido.
     */
    public function showTransporte($pedidoId)
    {
        $order = Order::with('shippingDetail')
                      ->findOrFail($pedidoId);
        abort_unless($order->user_id === Auth::id(), 403);

        $transportes = Transporte::whereIn('tipo', ['drone','moto','bicicleta'])
                                 ->get()
                                 ->groupBy('tipo');

        $drones     = $transportes->get('drone', collect())->map(fn($t) => tap($t, fn($m) => $m->selectable = $m->estado === 'activo'));
        $motos      = $transportes->get('moto', collect())->map(fn($t) => tap($t, fn($m) => $m->selectable = $m->estado === 'activo'));
        $bicicletas = $transportes->get('bicicleta', collect())->map(fn($t) => tap($t, fn($m) => $m->selectable = $m->estado === 'activo'));

        return view('pedidos_transporte', compact('order','drones','motos','bicicletas'));
    }

    /**
     * Asigna un transporte al pedido y redirige al monitoreo.
     */
    public function asignarTransporte(Request $request, $pedidoId)
    {
        $request->validate([
            'transporte_id' => 'required|exists:transportes,id',
        ]);

        $order = Order::findOrFail($pedidoId);
        abort_unless($order->user_id === Auth::id(), 403);

        $transporte = Transporte::findOrFail($request->transporte_id);
        abort_if($transporte->estado !== 'activo', 409, 'El transporte no está disponible.');

        $order->update([
            'transporte_id'  => $transporte->id,
            'estado_entrega' => 'en_curso',
        ]);

        $transporte->update(['estado' => 'ocupado']);

        return redirect()->route('pedidos.monitor', $order->id);
    }

    /**
     * Vista de monitoreo del pedido, con origen extraído del negocio 
     * asociado al primer ítem del pedido y destino del shippingDetail.
     */
    public function monitor($pedidoId)
{
    $order = Order::with(['transporte', 'items.establecimiento', 'shippingDetail'])
                  ->findOrFail($pedidoId);
    abort_unless($order->user_id === Auth::id(), 403);

    // Intentamos obtener el establecimiento de origen
    $firstItem = $order->items->first();
    $business  = $firstItem?->establecimiento;

    // Extraemos coordenadas, o null si no existen
    $originLat = $business->lat   ?? null;
    $originLng = $business->lng   ?? null;
    $destLat   = $order->shippingDetail->lat ?? null;
    $destLng   = $order->shippingDetail->lng ?? null;

    // Pasamos todo a la vista sin abortar
    return view('pedidos_monitor', [
        'order'      => $order,
        'originLat'  => $originLat,
        'originLng'  => $originLng,
        'destLat'    => $destLat,
        'destLng'    => $destLng,
    ]);
}


    /**
     * Provee en JSON la posición actual del transporte (polling AJAX).
     */
    public function position($pedidoId)
    {
        $order = Order::with('transporte')->findOrFail($pedidoId);
        abort_unless($order->user_id === Auth::id(), 403);

        $t = $order->transporte;
        return response()->json([
            'lat' => $t->lat,
            'lng' => $t->lng,
        ]);
    }
}
