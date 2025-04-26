<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class CatalogoComidaController extends Controller
{
    public function index()
    {
        // Traer todos los restaurantes (tabla 'restaurantes')
        $restaurantes = Restaurante::all();

        // Obtener tipos distintos de comida
        $tipos_comida = Restaurante::select('tipo')
                            ->distinct()
                            ->pluck('tipo')
                            ->toArray();

        return view('catalogo_comida', compact('restaurantes', 'tipos_comida'));
    }

    public function show($id)
    {
        $restaurante = Restaurante::findOrFail($id);
        return view('restaurante_detalle', compact('restaurante'));
    }
}
