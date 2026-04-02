<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/gerente/dashboard', function () {
        return view('gerente.dashboard');
    })->name('gerente.dashboard');

});