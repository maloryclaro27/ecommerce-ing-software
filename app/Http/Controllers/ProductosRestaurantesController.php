<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;

class ProductosRestaurantesController extends Controller
{
    /**
     * Listado de restaurantes (catálogo de comida)
     */
    public function index()
    {
        $restaurantes = Restaurante::all();
        return view('catalogo_comida', compact('restaurantes'));
    }

    /**
     * Productos de un restaurante
     */
    public function show($id)
    {
        // Eager loading de productos
        $restaurante = Restaurante::with('productos')->findOrFail($id);
        $productos   = $restaurante->productos;

        // Pasamos el contexto del establecimiento
        $establecimientoId   = $restaurante->id;
        $establecimientoTipo = 0; // 0 = Restaurante

        return view('menu_restaurante', compact(
            'restaurante',
            'productos',
            'establecimientoId',
            'establecimientoTipo'
        ));
    }
}
