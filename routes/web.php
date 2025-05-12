<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CatalogoComidaController;
use App\Http\Controllers\ProductosRestaurantesController;
use App\Http\Controllers\CatalogoDrogueriaController;
use App\Http\Controllers\CatalogoRopaController;
use App\Http\Controllers\CatalogoTecnologiaController;
use App\Http\Controllers\ProductosDrogueriasController;
use App\Http\Controllers\ProductosRopaController;
use App\Http\Controllers\ProductosTecnologiaController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PuntosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::view('/', 'welcome')->name('welcome');
Route::view('/ingreso', 'ingreso')->name('ingreso');
Route::get('/servicios', [ServiciosController::class, 'mostrarServicios'])->name('servicios');
Route::get('/informacion', function () {
    return view('informacion');
})->name('informacion');

// Registro
Route::get('/registro', [RegisterController::class, 'mostrarFormulario'])->name('registro');
Route::post('/registro/store', [RegisterController::class, 'registrar'])->name('registro.store');

// Login / Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Catálogo genérico (público)
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::view('/domicilios_programados', 'domicilios_programados')->name('domicilios_programados');

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {
    // Perfil, puntos y pedidos
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');
    Route::post('/perfil/update', [UserController::class, 'update'])->name('perfil.update');
    Route::get('/historial_pedidos', [PedidoController::class, 'historial'])->name('historial.pedidos');
    Route::get('/puntos', [PuntosController::class, 'index'])->name('puntos');

    // Catálogos por categoría
    Route::get('/catalogo/comida', [CatalogoComidaController::class, 'index'])->name('catalogo.comida');
    Route::get('/catalogo/comida/{id}', [ProductosRestaurantesController::class, 'show'])->name('catalogo.comida.show');

    Route::get('/catalogo/drogueria', [CatalogoDrogueriaController::class, 'index'])->name('catalogo.drogueria');
    Route::get('/catalogo/drogueria/{id}', [CatalogoDrogueriaController::class, 'show'])->name('catalogo.drogueria.show');

    Route::get('/catalogo/ropa', [CatalogoRopaController::class, 'index'])->name('catalogo.ropa');
    Route::get('/catalogo/ropa/{id}', [CatalogoRopaController::class, 'show'])->name('catalogo.ropa.show');

    Route::get('/catalogo/tecnologia', [CatalogoTecnologiaController::class, 'index'])->name('catalogo.tecnologia');
    Route::get('/catalogo/tecnologia/{id}', [CatalogoTecnologiaController::class, 'show'])->name('catalogo.tecnologia.show');

    // Productos individuales por tienda
    Route::get('restaurantes', [ProductosRestaurantesController::class, 'index'])->name('restaurantes.index');
    Route::get('restaurantes/{id}', [ProductosRestaurantesController::class, 'show'])->name('restaurantes.show');

    Route::get('droguerias', [ProductosDrogueriasController::class, 'index'])->name('droguerias.index');
    Route::get('droguerias/{id}', [ProductosDrogueriasController::class, 'show'])->name('droguerias.show');

    Route::get('ropa', [ProductosRopaController::class, 'index'])->name('ropa.index');
    Route::get('ropa/{id}', [ProductosRopaController::class, 'show'])->name('ropa.show');

    Route::get('tecnologia', [ProductosTecnologiaController::class, 'index'])->name('tecnologia.index');
    Route::get('tecnologia/{id}', [ProductosTecnologiaController::class, 'show'])->name('tecnologia.show');

    // Carrito y checkout
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{order}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{order}', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::view('/monitoreo-pedido', 'monitoreo_pedido_tienda')->name('monitoreo.pedido');
    Route::get('/pago_realizado/{order}', [CheckoutController::class, 'done'])->name('checkout.done');
});
