<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Gerente\InventarioController;
use App\Http\Controllers\Gerente\CategoriaController;
use App\Http\Controllers\Gerente\DashboardController;
use App\Http\Controllers\ClientesController;
use App\Livewire\PuntoVenta;



Route::get('/', function () {
    return view('welcome');
})->name('inicio');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ya iniciaron sesión
Route::middleware(['auth'])->group(function () {

    // Ruta para el Administrador
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Ruta para el Vendedor
    Route::get('/punto-venta', PuntoVenta::class)->name('punto-venta');

    // Ruta para el Gerente
    //CRUD de productos
    Route::prefix('gerente')->name('gerente.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::get('/create', [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('/', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/{producto}/edit', [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/{producto}', [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/{producto}', [InventarioController::class, 'destroy'])->name('inventario.destroy');

});
     //CRUD de categorias
    Route::prefix('gerente/categorias')->name('gerente.categorias.')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('index');
    Route::post('/', [CategoriaController::class, 'store'])->name('store');
    Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('destroy');
    //me falta el de actualizar
});

});
 //CRUD de clientes
    Route::prefix('gerente/clientes')->name('gerente.')->group(function () {
    Route::get('/', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');    

    
   
});


   
