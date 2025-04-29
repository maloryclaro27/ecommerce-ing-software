<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Muestra el formulario de registro
    public function mostrarFormulario()
    {
        return view('auth.registro');
    }

    // Procesa los datos y crea el usuario
    public function registrar(Request $request)
    {
        $datos = $request->validate([
            'nombre'                    => 'required|string|max:255',
            'correo_electronico'        => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'contrasena'                => 'required|string|min:6|confirmed',
            'identificacion'  => 'required|string|max:20',
        ]);

        User::create([
            'nombre'             => $datos['nombre'],
            'correo_electronico' => $datos['correo_electronico'],
            'contrasena'         => Hash::make($datos['contrasena']),
            'identificacion' => $datos['identificacion'],
        ]);

        return redirect()->route('home')
                         ->with('success', '¡Registro exitoso!');
    }
}


