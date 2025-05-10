<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function perfil()
    {
        $user = Auth::user();
        return view('perfil', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;

        if ($request->hasFile('foto_perfil')) {
            $ruta = $request->file('foto_perfil')->store('perfiles', 'public');
            $user->foto_perfil = $ruta;
        }

        $user->save();

        return back()->with('success', 'Datos actualizados.');
    }
}
