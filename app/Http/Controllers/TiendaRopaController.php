<?php

namespace App\Http\Controllers;

use App\Models\TiendaRopa;
use Illuminate\Http\Request;

class TiendaRopaController extends Controller
{
    public function index()
    {
        $ropas = TiendaRopa::orderBy('nombre')->paginate(10);
        return view('ropa.index', compact('ropas'));
    }

    public function create()
    {
        return view('ropa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        TiendaRopa::create($data);

        return redirect()->route('ropa.index')
                         ->with('success', 'Tienda de ropa creada correctamente.');
    }

    public function show(TiendaRopa $ropa)
    {
        return view('ropa.show', compact('ropa'));
    }

    public function edit(TiendaRopa $ropa)
    {
        return view('ropa.edit', compact('ropa'));
    }

    public function update(Request $request, TiendaRopa $ropa)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        $ropa->update($data);

        return redirect()->route('ropa.index')
                         ->with('success', 'Tienda de ropa actualizada correctamente.');
    }

    public function destroy(TiendaRopa $ropa)
    {
        $ropa->delete();
        return redirect()->route('ropa.index')
                         ->with('success', 'Tienda de ropa eliminada.');
    }
}
