@extends('layouts.templates.sellertem')

@section('title', 'Crear Producto')

@section('content')
    
    <div class="auth-wrapper mb-4">
        <a href="{{ route('gerente.dashboard') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            atrás
        </a>
    </div>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-600">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrar Nuevo Producto</h2>        

    <form action="{{ route('gerente.inventario.store') }}" method="POST">
        @csrf
        
        <label for="codigo" class="block text-sm font-semibold text-gray-700">Código:</label>
        <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" 
               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
               required>
        
        <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" 
                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                required>
        <br><br>

        <label for="existencias" class="block text-sm font-semibold text-gray-700">Stock (Existencias)</label>
        <input type="number" id="existencias" name="existencias" value="{{ old('existencias') }}" 
                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                required>
        <br><br>

        <label for="stock_minimo" class="block text-sm font-semibold text-gray-700">Stock Mínimo</label>
        <input type="number" id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo') }}" 
                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                required>
        <br><br>

        <label for="precio" class="block text-sm font-semibold text-gray-700">Precio de Venta ($)</label>
        <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio') }}" 
                class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                placeholder="0.00" required>
        <br><br>
        <label for="categoria_id" class="block text-sm font-semibold text-gray-700">Categoría</label>
            <select name="categoria_id" id="categoria_id" 
                    class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition bg-white" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
            </select>
        <br><br>

        <button type="submit" class="bg-green-600 text-white px-8 py-2 rounded-md font-bold hover:bg-green-700 shadow-sm transition">Crear Producto</button>
        <a href="{{ route('gerente.inventario.index') }}">Cancelar</a>
    </form>
@endsection
