<?php

namespace App\Http\Controllers;

use App\Models\TiendaRopa;

class CatalogoRopaController extends Controller
{
    /**
     * Mostrar listado de tiendas de ropa
     */
    public function index()
    {
        $tiendas = TiendaRopa::all();
        return view('catalogo_ropa', compact('tiendas'));
    }

    /**
     * Mostrar productos de una tienda de ropa
     */
    public function show($id)
    {
        $tienda = TiendaRopa::with('productos')->findOrFail($id);
        return view('tienda_ropa_detalle', compact('tienda'));
    }
}
