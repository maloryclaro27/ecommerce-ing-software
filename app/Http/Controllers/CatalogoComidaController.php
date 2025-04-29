<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;

class CatalogoComidaController extends Controller
{
    /**
     * Mostrar listado de restaurantes y tipos de comida
     */
    public function index()
    {
        // Traer todos los restaurantes
        $restaurantes = Restaurante::all();

        // Obtener tipos distintos de comida
        $tipos_comida = Restaurante::select('tipo')
            ->distinct()
            ->pluck('tipo')
            ->toArray();

        return view('catalogo_comida', compact('restaurantes', 'tipos_comida'));
    }

    /**
     * Mostrar detalle de un restaurante con sus productos
     */
    public function show($id)
    {
        $restaurante = Restaurante::with('productos')
            ->findOrFail($id);

        return view('restaurante_detalle', compact('restaurante'));
    }
}
