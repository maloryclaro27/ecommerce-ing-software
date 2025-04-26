<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class CatalogoRopaController extends Controller
{
    public function index()
    {
        // Traer todas las tiendas de ropa
        $tiendas = Tienda::all();
        return view('catalogo_ropa', compact('tiendas'));
    }

    public function show($id)
    {
        // Detalle de una tienda
        $tienda = Tienda::findOrFail($id);
        return view('tienda_ropa_detalle', compact('tienda'));
    }
}

