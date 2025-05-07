<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiciosController extends Controller
{
    public function mostrarServicios(Request $request){

        if (!Auth::check()) {
            // Guarda específicamente la URL de servicios como intended
            $request->session()->put('url.intended', route('servicios'));
            return redirect()->route('login');
        }
        
        return view('servicios');

    }
}
