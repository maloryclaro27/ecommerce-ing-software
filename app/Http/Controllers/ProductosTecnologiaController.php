<?php

namespace App\Http\Controllers;

use App\Models\TiendaTecnologia;

class ProductosTecnologiaController extends Controller
{
    /**
     * Listado de droguerías (catálogo de droguerías)
     */
    public function index()
    {
        $tecnologias = TiendaTecnologia::all();
        return view('catalogo_ropa', compact('tecnologias'));
    }

    /**
     * Productos de una droguería
     */
    public function show($id)
    {
        // Eager-load para evitar consultas N+1
        $tecnologia = TiendaTecnologia::with('productos')->findOrFail($id);

        // Extraigo la colección de productos
        $productos = $tecnologia->productos;

        return view('inventario_tecnologia', compact('tecnologia', 'productos'));
    }
}