<?php

namespace App\Http\Controllers;

use App\Models\Drogueria;

class ProductosDrogueriasController extends Controller
{
    /**
     * Listado de droguerías (catálogo de droguerías)
     */
    public function index()
    {
        $droguerias = Drogueria::all();
        return view('catalogo_drogueria', compact('droguerias'));
    }

    /**
     * Productos de una droguería
     */
    public function show($id)
    {
        // Eager-load para evitar consultas N+1
        $drogueria = Drogueria::with('productos')->findOrFail($id);

        // Extraigo la colección de productos
        $productos = $drogueria->productos;

        return view('inventario_droguerias', compact('drogueria', 'productos'));
    }
}
