@extends('layouts.templates.sellertem')

@section('title', 'Actualizar Producto')

@section('content')

{{-- Botón Atrás --}}
<div class="auth-wrapper mb-4">
    <a href="{{ route('gerente.inventario.index') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        atrás
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-600">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Actualizar Producto</h2>
            <p class="text-sm text-gray-500 font-medium">Modifica la información necesaria para el producto: <span class="text-blue-600">{{ $producto->nombre }}</span></p>
        </div>

        <form action="{{ route('gerente.inventario.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="codigo" class="block text-sm font-semibold text-gray-700">Código del Producto</label>
                    <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $producto->codigo) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50" required>
                </div>
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>
                <div>
                    <label for="existencias" class="block text-sm font-semibold text-gray-700">Existencias Actuales</label>
                    <input type="number" id="existencias" name="existencias" value="{{ old('existencias', $producto->existencias) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>

                <div>
                    <label for="stock_minimo" class="block text-sm font-semibold text-gray-700">Stock Mínimo (Alerta)</label>
                    <input type="number" id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="precio" class="block text-sm font-semibold text-gray-700">Precio de Venta ($)</label>
                    <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio', $producto->precio) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>
                <div>
                    <label for="categoria_id" class="block text-sm font-semibold text-gray-700">Categoría</label>
                    <select name="categoria_id" id="categoria_id" 
                            class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition bg-white" required>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-4 border-t pt-6">
                <a href="{{ route('gerente.inventario.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white font-bold py-2.5 px-8 rounded-md hover:bg-blue-700 shadow-lg shadow-blue-200 transition transform active:scale-95">
                    Actualizar Información
                </button>
            </div>
        </form>
    </div>
</div>
@endsection