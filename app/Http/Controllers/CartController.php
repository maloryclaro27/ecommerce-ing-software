<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\CartItem;

class CartController extends Controller
{
    /**
     * Agrega un producto al carrito (o incrementa cantidad).
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id'         => 'required|exists:productos,id',
            'establecimiento_id'  => 'required|integer',
            'establecimiento_tipo'=> 'required|integer',
        ]);

        $user = Auth::user();
        $prod = Producto::findOrFail($request->producto_id);

        // Validar que no haya ítems de otro establecimiento
        $existing = $user->cartItems()->first();
        if ($existing
            && ($existing->establecimiento_id != $request->establecimiento_id
                || $existing->establecimiento_tipo != $request->establecimiento_tipo)
        ) {
            return back()->withErrors('Solo puedes agregar productos de un mismo local por pedido.');
        }

        // Crear o actualizar cantidad
        $item = $user->cartItems()
                     ->where('producto_id', $prod->id)
                     ->first();

        if ($item) {
            $item->increment('cantidad');
        } else {
            $user->cartItems()->create([
                'producto_id'         => $prod->id,
                'establecimiento_id'  => $request->establecimiento_id,
                'establecimiento_tipo'=> $request->establecimiento_tipo,
                'cantidad'            => 1,
            ]);
        }

        return back()->with('status', 'Producto agregado al carrito.');
    }

    /**
     * Muestra los ítems del carrito y el total.
     */
    public function index()
    {
        $user  = Auth::user();
        $items = $user->cartItems()->with('producto')->get();
        $total = $items->sum(fn($i) => $i->producto->precio * $i->cantidad);

        return view('carrito', compact('items', 'total'));
    }

    /**
     * Elimina un ítem del carrito.
     */
    public function destroy(CartItem $item)
    {
        // Opcional: verifica que el ítem pertenezca al usuario
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        if ($item->cantidad > 1) {
            // Si hay más de 1, decrementa en 1
            $item->decrement('cantidad');
        } else {
            // Si solo queda 1, elimina el registro
            $item->delete();
        }
    }
}
