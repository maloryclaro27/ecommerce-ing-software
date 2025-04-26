<?php

namespace App\Http\Controllers;

use App\Models\Drogueria;
use Illuminate\Http\Request;

class CatalogoDrogueriaController extends Controller
{
    public function index()
    {
        // Traer todas las droguerías
        $droguerias = Drogueria::all();

        return view('catalogo_drogueria', compact('droguerias'));
    }

    public function show($id)
    {
        $drogueria = Drogueria::findOrFail($id);
        return view('drogueria_detalle', compact('drogueria'));
    }
}
