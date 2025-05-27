<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transporte;

class TransportesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Drones: activo, ocupado e inactivo
        Transporte::create([
            'tipo'                => 'drone',   // <-- aquí
            'estado'              => 'activo',
            'nombre_domiciliario' => null,
            'lat'                 => null,
            'lng'                 => null,
        ]);
        Transporte::create([
            'tipo'                => 'drone',
            'estado'              => 'ocupado',
            'nombre_domiciliario' => null,
            'lat'                 => null,
            'lng'                 => null,
        ]);
        Transporte::create([
            'tipo'                => 'drone',
            'estado'              => 'inactivo',
            'nombre_domiciliario' => null,
            'lat'                 => null,
            'lng'                 => null,
        ]);

        // Moto
        Transporte::create([
            'tipo'                => 'moto',
            'estado'              => 'activo',
            'nombre_domiciliario' => 'Juan Pérez',
            'lat'                 => null,
            'lng'                 => null,
        ]);

        // Bicicleta
        Transporte::create([
            'tipo'                => 'bicicleta',
            'estado'              => 'activo',
            'nombre_domiciliario' => 'María Gómez',
            'lat'                 => null,
            'lng'                 => null,
        ]);
    }
}
