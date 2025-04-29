<?php

namespace App\Http\Controllers;

use App\Models\Drogueria;

class CatalogoDrogueriaController extends Controller
{
    /**
     * Mostrar listado de droguerías
     */
    public function index()
    {
        $droguerias = Drogueria::all();
        return view('catalogo_drogueria', compact('droguerias'));
    }

    /**
     * Mostrar productos de una droguería
     */
    public function show($id)
    {
        $drogueria = Drogueria::with('productos')
            ->findOrFail($id);
        
        return view('drogueria_detalle', compact('drogueria'));
    }
}
