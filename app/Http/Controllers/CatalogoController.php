<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Catalogo;
use App\Models\Producto;

class CatalogoController extends Controller
{
    public function index()
    {
        // Categorías con slug
        $categorias = Catalogo::all()->map(function ($item) {
            $item->slug = Str::slug($item->titulo);
            return $item;
        });
        return view('catalogo', compact('categorias'));
    }


    public function show($slug)
    {
        // Recupera la categoría por slug
        $categoria = Catalogo::all()
            ->map(function($item){
                $item->slug = Str::slug($item->titulo);
                return $item;
            })
            ->firstWhere('slug', $slug);

        abort_unless($categoria, 404);

        // Trae los productos de esa categoría
        $products = Producto::with('owner')
                      ->where('category_id', $categoria->id)
                      ->get();

        return view('catalogo.show', compact('categoria', 'products'));
    
        // **Aquí** traes todos los productos (incluye los creados por dueños)
        $products = Producto::with('owner')->get();

        // Pasas ambas colecciones a la vista
        return view('catalogo', compact('categorias', 'products'));
    }
}
