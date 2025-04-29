<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CatalogoComidaController;
use App\Http\Controllers\ProductosRestaurantesController;
use App\Http\Controllers\CatalogoDrogueriaController;
use App\Http\Controllers\CatalogoRopaController;
use App\Http\Controllers\CatalogoTecnologiaController;
use App\Http\Controllers\ProductosDrogueriasController;
use App\Http\Controllers\ProductosRopaController;
use App\Http\Controllers\ProductosTecnologiaController;






// Página de bienvenida y estáticas
Route::view('/', 'welcome')->name('welcome');
Route::view('/ingreso', 'ingreso')->name('ingreso');
Route::view('/login', 'login')->name('login');
Route::view('/registro', 'registro')->name('registro');
Route::view('/servicios', 'servicios')->name('servicios');

// Catálogo genérico
Route::get('/catalogo', [CatalogoController::class, 'index'])
    ->name('catalogo');

// --- Listado de Restaurantes ---
Route::get('/catalogo/comida', [CatalogoComidaController::class, 'index'])
    ->name('catalogo.comida'); //va a la vista del listado de restaurantes

Route::get('/catalogo/comida/{id}', [ProductosRestaurantesController::class, 'show'])
    ->name('catalogo.comida.show'); // va a cada restaurante dependiendo del id

// --- Listado de Droguerías ---
Route::get('/catalogo/drogueria', [CatalogoDrogueriaController::class, 'index'])
    ->name('catalogo.drogueria');

Route::get('/catalogo/drogueria/{id}', [CatalogoDrogueriaController::class, 'show'])
    ->name('catalogo.drogueria.show');

// --- Listado de Tiendas de ropa ---
Route::get('/catalogo/ropa', [CatalogoRopaController::class, 'index'])
    ->name('catalogo.ropa');

Route::get('/catalogo/ropa/{id}', [CatalogoRopaController::class, 'show'])
    ->name('catalogo.ropa.show');

// --- Listado de Tiendas de tecnología ---
Route::get('/catalogo/tecnologia', [CatalogoTecnologiaController::class, 'index'])
    ->name('catalogo.tecnologia');

Route::get('/catalogo/tecnologia/{id}', [CatalogoTecnologiaController::class, 'show'])
    ->name('catalogo.tecnologia.show');


Route::get('droguerias', [ProductosRestaurantesController::class, 'index'])
->name('restaurantes.index');

Route::get('restaurantes/{id}', [ProductosRestaurantesController::class, 'show'])
->name('restaurantes.show');

Route::get('droguerias', [ProductosDrogueriasController::class, 'index'])
->name('droguerias.index');

Route::get('droguerias/{id}', [ProductosDrogueriasController::class, 'show'])
->name('droguerias.show');

Route::get('ropa', [ProductosRopaController::class, 'index'])
->name('ropa.index');

Route::get('ropa/{id}', [ProductosRopaController::class, 'show'])
->name('ropa.show');

Route::get('tecnologia', [ProductosTecnologiaController::class, 'index'])
->name('tecnologia.index');

Route::get('tecnologia/{id}', [ProductosTecnologiaController::class, 'show'])
->name('tecnologia.show');
    

