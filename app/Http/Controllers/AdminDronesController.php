<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transporte;

class AdminDronesController extends Controller
{
    /**
     * Muestra la lista de drones registrados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene solo los transportes de tipo 'drone'
        $drones = Transporte::where('tipo', 'drone')->get();

        // Retorna la vista con los datos de drones
        return view('admin_drones', compact('drones'));
    }
}
