<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar la lista y el formulario
    public function index()
    {
        $categorias = Categoria::all();
        return view('gerente.categorias.index', compact('categorias'));
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|unique:categorias,nombre',
            'descripcion' => 'nullable|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('gerente.categorias.index')
                         ->with('success', 'Categoría creada exitosamente.');
    }


    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('gerente.categorias.index')
                         ->with('success', 'Categoría eliminada.');
    }
}