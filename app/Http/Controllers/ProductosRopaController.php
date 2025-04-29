<?php

namespace App\Http\Controllers;

use App\Models\TiendaRopa;

class ProductosRopaController extends Controller
{
    /**
     * Listado de droguerías (catálogo de droguerías)
     */
    public function index()
    {
        $tienda = TiendaRopa::all();
        return view('catalogo_ropa', compact('tienda'));
    }

    /**
     * Productos de una droguería
     */
    public function show($id)
    {
        // Eager-load para evitar consultas N+1
        $tienda = TiendaRopa::with('productos')->findOrFail($id);

        // Extraigo la colección de productos
        $productos = $tienda->productos;

        return view('inventario_ropa', compact('tienda', 'productos'));
    }
}