<?php

namespace App\Http\Controllers;

use App\Models\TiendaTecnologia;
use Illuminate\Http\Request;

class CatalogoTecnologiaController extends Controller
{
    public function index()
    {
        $tiendas = TiendaTecnologia::all();
        return view('catalogo_tecnologia', compact('tiendas'));
    }

    public function show($id)
    {
        $tienda = TiendaTecnologia::findOrFail($id);
        return view('tecnologia_detalle', compact('tienda'));
    }
}
