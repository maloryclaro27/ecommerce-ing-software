<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Página de monitoreo de drones (en construcción)
    public function monitoreoDrones()
    {
        return view('admin.drones'); // Asegúrate de crear esta vista
    }
}
