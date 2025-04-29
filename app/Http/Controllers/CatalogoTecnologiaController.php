<?php

namespace App\Http\Controllers;

use App\Models\TiendaTecnologia;

class CatalogoTecnologiaController extends Controller
{
    /**
     * Mostrar listado de tiendas de tecnología
     */
    public function index()
    {
        $tiendas = TiendaTecnologia::all();
        return view('catalogo_tecnologia', compact('tiendas'));
    }

    /**
     * Mostrar productos de una tienda de tecnología
     */
    public function show($id)
    {
        $tienda = TiendaTecnologia::with('productos')->findOrFail($id);
        return view('tienda_tecnologia_detalle', compact('tienda'));
    }
}
