<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    /**
     * Mostrar lista de restaurantes (admin).
     */
    public function index()
    {
        $restaurantes = Restaurante::orderBy('nombre')->paginate(10);
        return view('restaurantes.index', compact('restaurantes'));
    }

    /**
     * Formulario para crear nuevo restaurante.
     */
    public function create()
    {
        return view('restaurantes.create');
    }

    /**
     * Almacenar restaurante nuevo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
            // otros campos que tengas…
        ]);

        Restaurante::create($data);

        return redirect()->route('restaurantes.index')
                         ->with('success', 'Restaurante creado correctamente.');
    }

    /**
     * Mostrar detalle de un restaurante (opcional).
     */
    public function show(Restaurante $restaurante)
    {
        return view('restaurantes.show', compact('restaurante'));
    }

    /**
     * Formulario para editar restaurante.
     */
    public function edit(Restaurante $restaurante)
    {
        return view('restaurantes.edit', compact('restaurante'));
    }

    /**
     * Actualizar datos de un restaurante.
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:90',
            'direccion' => 'required|string|max:255',
            'lat'       => 'required|numeric|between:-90,90',
            'lng'       => 'required|numeric|between:-180,180',
        ]);

        $restaurante->update($data);

        return redirect()->route('restaurantes.index')
                         ->with('success', 'Restaurante actualizado correctamente.');
    }

    /**
     * Eliminar un restaurante.
     */
    public function destroy(Restaurante $restaurante)
    {
        $restaurante->delete();
        return redirect()->route('restaurantes.index')
                         ->with('success', 'Restaurante eliminado.');
    }
}
