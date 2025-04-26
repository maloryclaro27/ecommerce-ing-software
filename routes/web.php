<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoComidaController;
use App\Http\Controllers\CatalogoDrogueriaController;
use App\Http\Controllers\CatalogoRopaController;
use App\Http\Controllers\CatalogoTecnologiaController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/ingreso', function () {
    return view('ingreso');
})->name('ingreso');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

// Rutas para el catálogo
Route::get('/catalogo', function () {
    return view('catalogo');
})->name('catalogo');

// Página de catálogo (lista de todos los restaurantes)
Route::get('/catalogo/comida', [CatalogoComidaController::class, 'index'])
     ->name('catalogo.comida');

// Página de detalle (show) de cada restaurante
Route::get('/catalogo/comida/{id}', [CatalogoComidaController::class, 'show'])
     ->name('catalogo.comida.show');

Route::get('/catalogo/drogueria', [CatalogoDrogueriaController::class, 'index'])
     ->name('catalogo.drogueria');

// Detalle
Route::get('/catalogo/drogueria/{id}', [CatalogoDrogueriaController::class, 'show'])
     ->name('catalogo.drogueria.show');

Route::get('/catalogo/ropa', [CatalogoRopaController::class, 'index'])
     ->name('catalogo.ropa');

// Detalle
Route::get('/catalogo/ropa/{id}', [CatalogoRopaController::class, 'show'])
     ->name('catalogo.ropa.show');
 

Route::get('/catalogo/tecnologia', [CatalogoTecnologiaController::class, 'index'])
     ->name('catalogo.tecnologia');
     
         // Detalle de cada tienda tech
Route::get('tecnologia/{id}', [CatalogoTecnologiaController::class, 'show'])
     ->name('catalogo.tecnologia.show');
     
     


