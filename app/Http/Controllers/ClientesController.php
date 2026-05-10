<?php

namespace App\Http\Controllers;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::all();
        return view('gerente.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gerente.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'nullable|email|unique:clientes,email',
            'documento_identidad' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
        ]);

        Clientes::create($request->all());

        return redirect()->route('gerente.clientes.index')->with('success', 'Cliente creado exitosamente');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('gerente.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Clientes::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'nullable|email|unique:clientes,email,' . $id,
            'documento_identidad' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
        ]);

        $cliente->update($request->all());

        return redirect()->route('gerente.clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();

        return redirect()->route('gerente.clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
