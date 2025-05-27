<?php

namespace App\Http\Controllers;

use App\Models\TiendaTecnologia;
use Illuminate\Http\Request;

class TiendaTecnologiaController extends Controller
{
    public function index()
    {
        $tecnologias = TiendaTecnologia::orderBy('nombre')->paginate(10);
        return view('tecnologia.index', compact('tecnologias'));
    }

    public function create()
    {
        return view('tecnologia.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        TiendaTecnologia::create($data);

        return redirect()->route('tecnologia.index')
                         ->with('success', 'Tienda de tecnología creada correctamente.');
    }

    public function show(TiendaTecnologia $tecnologia)
    {
        return view('tecnologia.show', compact('tecnologia'));
    }

    public function edit(TiendaTecnologia $tecnologia)
    {
        return view('tecnologia.edit', compact('tecnologia'));
    }

    public function update(Request $request, TiendaTecnologia $tecnologia)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        $tecnologia->update($data);

        return redirect()->route('tecnologia.index')
                         ->with('success', 'Tienda de tecnología actualizada correctamente.');
    }

    public function destroy(TiendaTecnologia $tecnologia)
    {
        $tecnologia->delete();
        return redirect()->route('tecnologia.index')
                         ->with('success', 'Tienda de tecnología eliminada.');
    }
}
