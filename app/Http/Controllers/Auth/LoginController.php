<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        // 1) Validar entrada
        $credentials = $request->validate([
            'correo_electronico' => 'required|string|email',
            'contrasena'         => 'required|string|min:6',
        ]);

        // 2) Intentar autenticación.
        // Auth::attempt usará tu método getAuthPassword() para comparar contrasena hasheada
        if (Auth::attempt([
            'correo_electronico' => $credentials['correo_electronico'],
            'password'           => $credentials['contrasena']
        ], $request->filled('remember'))) {
            // Regenera sesión para prevenir fijación
            $request->session()->regenerate();

            // Redirige al usuario a donde quería ir o al catálogo
            return redirect()->intended(route('catalogo.comida'));
        }

        // 3) Falló autenticación: volver con error
        return back()
            ->withErrors(['correo_electronico' => 'Credenciales inválidas'])
            ->withInput($request->only('correo_electronico'));
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    // Indica a Auth que el campo “usuario” se llama correo_electronico
    protected function username()
    {
        return 'correo_electronico';
    }
}
