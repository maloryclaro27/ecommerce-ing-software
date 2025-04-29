<?php

namespace App\Http\Controllers;
use App\Models\Catalogo;
use Illuminate\Support\Str;

class CatalogoController extends Controller
{
    public function index()
    {
        // Trae todas las filas de la tabla 'catalogo'
        $categorias = Catalogo::all()->map(function($item) {
            // Genera un "slug" a partir del título para la ruta
            $item->slug = Str::slug($item->titulo);
            return $item;
        });

        return view('catalogo', compact('categorias'));
    }
}
