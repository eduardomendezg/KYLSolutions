<?php


namespace App\Http\Controllers\Gerente;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        // Datos para la vista
        $conteoProductos = Producto::count();
        $conteoCategorias = Categoria::count();
        
        // mostrar el stock
        $stockBajo = Producto::where('existencias', '<=', 5)->count();

        // mostrar los ultimos productos agregados
        $ultimosProductos = Producto::latest()->take(5)->get();

        return view('gerente.dashboard', compact(
            'conteoProductos', 
            'conteoCategorias', 
            'stockBajo', 
            'ultimosProductos'
        ));
    }
}