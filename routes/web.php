<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarioController;

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
    Route::get('/vendedor/ventana', function () {
        return view('vendedor.ventana');
    })->name('vendedor.ventana');

    // Ruta para el Gerente
    //CRUD de productos
    Route::get('/gerente/inventario/inventario', [InventarioController::class, 'index'])->name('gerente.inventario.index');
    Route::get('/gerente/inventario/create', [InventarioController::class, 'create'])->name('crear');
    Route::post('/gerente/inventario/inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/gerente/inventario/{producto}/edit', [InventarioController::class, 'edit'])->name('gerente.inventario.edit');
    Route::put('/gerente/inventario/inventario/{producto}', [InventarioController::class, 'update'])->name('gerente.inventario.update');
    Route::delete('/gerente/inventario/inventario/{producto}', [InventarioController::class, 'destroy'])->name('gerente.inventario.destroy');
});
