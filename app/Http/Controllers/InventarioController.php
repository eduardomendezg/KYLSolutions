<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
class InventarioController extends Controller
{
    public function index()
{
    $productos = Producto::with('categoria')->orderBy('id', 'desc')->get();
    return view('gerente.inventario.inventario', compact('productos'));
}
public function create()
{
    $categorias =Categoria::all();
    return view('gerente.inventario.create', compact('categorias'));
}
public function store(Request $request)
{
    $request->validate([

    'codigo'=>'required|unique:productos',
    'nombre'=>'required',
    'precio'=>'required|numeric',
    'existencias'=>'required|integer',
    'categoria_id'=>'required|exists:categorias,id'
    ]);
    Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'existencias' => $request->existencias,
            'stock_minimo' => $request->stock_minimo,
            'categoria_id' => $request->categoria_id,
    ]);

    return redirect()->route('gerente.inventario.index')->with('success', 'Producto creado exitosamente.');
}
public function edit($id)

{   
 
    $producto = Producto::findOrFail($id);
    $categorias =Categoria::all(); 
    return view('gerente.inventario.edit', compact('producto', 'categorias'));
}
public function update(Request $request, $id)
{

$producto = Producto::findOrFail($id);
$request->validate([
    'codigo'=>'required|string|max:13|unique:productos,codigo,' .$id,
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'existencias' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
]);

    $producto->update($request->all());
    return redirect()->route('gerente.inventario.index')->with('success', 'Producto actualizado exitosamente.');
}
public function destroy($id)
{
    Producto::findOrFail($id)->delete();
    return redirect()->route('gerente.inventario.index')->with('success', 'Producto eliminado exitosamente.');
}
}
