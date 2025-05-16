<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurante;
use App\Models\Drogueria;
use App\Models\TiendaRopa;
use App\Models\TiendaTecnologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            'nombre'             => 'required|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'password'           => 'required|string|min:6',
            'identificacion'     => 'required|string|max:20',
            'rol'                => 'required|in:cliente,dueno,admin',
            'categoria_negocio'  => 'nullable|string|in:comida,drogueria,ropa,tecnologia',
            'nombre_negocio'     => 'nullable|string|max:255',
        ]);

        try {
            // Crear el usuario
            $user = new User();
            $user->nombre = $datos['nombre'];
            $user->correo_electronico = $datos['correo_electronico'];
            $user->contrasena = Hash::make($datos['password']);
            $user->identificacion = $datos['identificacion'];
            $user->rol = $datos['rol'];
            $user->categoria_negocio = ($datos['rol'] === 'dueno') ? $datos['categoria_negocio'] : null;
            $user->nombre_negocio = ($datos['rol'] === 'dueno') ? $datos['nombre_negocio'] : null;

            $user->save();

            Auth::login($user);

            // Si es dueño, depurar y registrar negocio
            if ($user->rol === 'dueno') {
                // DEBUG: verificar entrada en la rama dueno
                switch ($user->categoria_negocio) {
                    case 'comida':
                        Restaurante::create([
                            'nombre'  => $user->nombre_negocio,
                            'user_id' => $user->id,
                        ]);
                        break;

                    case 'drogueria':
                        Drogueria::create([
                            'nombre'  => $user->nombre_negocio,
                            'user_id' => $user->id,
                        ]);
                        break;

                    case 'ropa':
                        TiendaRopa::create([
                            'nombre'  => $user->nombre_negocio,
                            'user_id' => $user->id,
                        ]);
                        break;

                    case 'tecnologia':
                        TiendaTecnologia::create([
                            'nombre'  => $user->nombre_negocio,
                            'user_id' => $user->id,
                        ]);
                        break;
                }

                return redirect()->route('negocio.catalogo')
                                 ->with('success', '¡Cuenta de dueño creada y negocio registrado!');
            }

            // Cliente o admin
            return redirect()->route('welcome')
                             ->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            Log::error('❌ Error al registrar usuario', [
                'mensaje' => $e->getMessage(),
                'traza'   => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }
}
