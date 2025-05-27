<?php

namespace App\Http\Controllers;

use App\Models\Drogueria;
use Illuminate\Http\Request;

class DrogueriaController extends Controller
{
    public function index()
    {
        $droguerias = Drogueria::orderBy('nombre')->paginate(10);
        return view('droguerias.index', compact('droguerias'));
    }

    public function create()
    {
        return view('droguerias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
            // añade aquí validación para otros campos (imagen, user_id, etc.)
        ]);

        Drogueria::create($data);

        return redirect()->route('droguerias.index')
                         ->with('success', 'Droguería creada correctamente.');
    }

    public function show(Drogueria $drogueria)
    {
        return view('droguerias.show', compact('drogueria'));
    }

    public function edit(Drogueria $drogueria)
    {
        return view('droguerias.edit', compact('drogueria'));
    }

    public function update(Request $request, Drogueria $drogueria)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        $drogueria->update($data);

        return redirect()->route('droguerias.index')
                         ->with('success', 'Droguería actualizada correctamente.');
    }

    public function destroy(Drogueria $drogueria)
    {
        $drogueria->delete();
        return redirect()->route('droguerias.index')
                         ->with('success', 'Droguería eliminada.');
    }
}
