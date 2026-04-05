<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function index()
{
    $productos = Producto::orderBy('id', 'desc')->get();
    return view('gerente.inventario.inventario', compact('productos'));
}
public function create()
{
    return view('gerente.inventario.create');
}
public function store(Request $request)
{
    $productos  = new Producto();

    $productos->nombre = $request->nombre;
    $productos->stock = $request->stock;
    $productos->precio = $request->precio;
    $productos->save();

    return redirect()->route('gerente.inventario.index')->with('success', 'Producto creado exitosamente.');
}
public function edit(Producto $producto)
{    return view('gerente.inventario.edit', compact('producto'));
}
public function update(Request $request, Producto $producto)
{
    $producto->nombre = $request->nombre;
    $producto->stock = $request->stock;
    $producto->precio = $request->precio;
    $producto->save();

    return redirect()->route('gerente.inventario.index')->with('success', 'Producto actualizado exitosamente.');
}
public function destroy(Producto $producto)
{
    $producto->delete();
    return redirect()->route('gerente.inventario.index')->with('success', 'Producto eliminado exitosamente.');
}
}
