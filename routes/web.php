<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controladores de autenticación
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Controladores de catálogo público
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CatalogoComidaController;
use App\Http\Controllers\CatalogoDrogueriaController;
use App\Http\Controllers\CatalogoRopaController;
use App\Http\Controllers\CatalogoTecnologiaController;

// Controladores de productos por tienda
use App\Http\Controllers\ProductosRestaurantesController;
use App\Http\Controllers\ProductosDrogueriasController;
use App\Http\Controllers\ProductosRopaController;
use App\Http\Controllers\ProductosTecnologiaController;

// Otros controladores
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PuntosController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\AdminController;

// Controladores CRUD negocios
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\DrogueriaController;
use App\Http\Controllers\TiendaRopaController;
use App\Http\Controllers\TiendaTecnologiaController;


/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('welcome');
Route::view('/ingreso', 'ingreso')->name('ingreso');
Route::get('/servicios', [ServiciosController::class, 'mostrarServicios'])->name('servicios');
Route::get('/informacion', function () {
    return view('informacion');
})->name('informacion');

/*
|--------------------------------------------------------------------------
| Registro
|--------------------------------------------------------------------------
*/
Route::get('/registro', [RegisterController::class, 'mostrarFormulario'])->name('registro');
Route::post('/registro/store', [RegisterController::class, 'registrar'])->name('registro.store');

/*
|--------------------------------------------------------------------------
| Login / Logout
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Catálogo genérico (público)
|--------------------------------------------------------------------------
*/
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::view('/domicilios_programados', 'domicilios_programados')->name('domicilios_programados');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (autenticación requerida)
|--------------------------------------------------------------------------
*/
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

    Route::get('/catalogo/{slug}', [CatalogoController::class, 'show'])
         ->where('slug', '^(?!comida$|drogueria$|ropa$|tecnologia$).+')
         ->name('catalogo.show');

    // Productos individuales por tienda
    Route::get('restaurantes', [ProductosRestaurantesController::class, 'index'])->name('restaurantes.index');
    Route::get('restaurantes/{id}', [ProductosRestaurantesController::class, 'show'])->name('restaurantes.show');

    Route::get('droguerias', [ProductosDrogueriasController::class, 'index'])->name('droguerias.index');
    Route::get('droguerias/{id}', [ProductosDrogueriasController::class, 'show'])->name('droguerias.show');

    Route::get('ropa', [ProductosRopaController::class, 'index'])->name('ropa.index');
    Route::get('ropa/{id}', [ProductosRopaController::class, 'show'])->name('ropa.show');

    Route::get('tecnologia', [ProductosTecnologiaController::class, 'index'])->name('tecnologia.index');
    Route::get('tecnologia/{id}', [ProductosTecnologiaController::class, 'show'])->name('tecnologia.show');

    // Carrito y Checkout
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{order}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{order}', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/{order}/done', [CheckoutController::class, 'done'])
         ->name('checkout.done');

    /*
    |--------------------------------------------------------------------------
    | Transporte / Monitoreo de pedidos
    |--------------------------------------------------------------------------
    */
    Route::get('/pedidos/{pedido}/transporte', [PedidoController::class, 'showTransporte'])
         ->name('pedidos.transporte.seleccionar');

    Route::post('/pedidos/{pedido}/transporte', [PedidoController::class, 'asignarTransporte'])
         ->name('pedidos.transporte.asignar');

    Route::get('/pedidos/{pedido}/monitor', [PedidoController::class, 'monitor'])
         ->name('pedidos.monitor');
     
     Route::get('/pedidos/{pedido}/position', [PedidoController::class, 'position'])
         ->name('pedidos.position');

    /*
    |--------------------------------------------------------------------------
    | CRUD Administración de negocios
    |--------------------------------------------------------------------------
    */
    Route::resource('restaurantes', RestauranteController::class);
    Route::resource('droguerias',  DrogueriaController::class);
    Route::resource('ropa',        TiendaRopaController::class);
    Route::resource('tecnologia',  TiendaTecnologiaController::class);

    /*
    |--------------------------------------------------------------------------
    | Rutas para dueños de negocio ("Mi negocio")
    |--------------------------------------------------------------------------
    */
    Route::get('/mi-negocio',                 [NegocioController::class, 'catalogo'])->name('negocio.catalogo');
    Route::get('/mi-negocio/estadisticas',    [NegocioController::class, 'estadisticas'])->name('negocio.estadisticas');
    Route::get('/mi-negocio/configuracion',    [NegocioController::class, 'configuracion'])->name('negocio.configuracion');
    Route::get('/mi-negocio/domicilios',      [NegocioController::class, 'domicilios'])->name('negocio.domicilios');
    Route::post('/business/{id}/products',    [NegocioController::class, 'store']);
    Route::put('/business/{id}/products/{productId}', [NegocioController::class, 'update']);
    Route::delete('/business/{id}/products/{productId}', [NegocioController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Panel de administrador
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/drones', [AdminController::class, 'monitoreoDrones'])
         ->name('admin.drones');
});
