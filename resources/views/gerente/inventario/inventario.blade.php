@extends('layouts.templates.sellertem')

@section('title', 'Inventario de Productos')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <div class="auth-wrapper mb-4">
        <a href="{{ route('gerente.dashboard') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            atrás
        </a>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Inventario de Productos</h1>
        
        <div class="flex gap-3">
            <a href="{{ route('gerente.categorias.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 transition">
                Categorías
            </a>
            <a href="{{ route('gerente.inventario.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 shadow-md transition">
                + Agregar
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-center">Código</th>
                    <th class="px-6 py-4 font-bold">Producto</th>
                    <th class="px-6 py-4 font-bold">Categoría</th>
                    <th class="px-6 py-4 font-bold text-center">Precio</th>
                    <th class="px-6 py-4 font-bold text-center">Stock</th>
                    <th class="px-6 py-4 font-bold text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($productos as $producto)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-center font-mono text-gray-600">
                        {{ $producto->codigo }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        {{ $producto->nombre }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $producto->Categoria->nombre ?? 'Sin categoría' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-gray-900">
                        ${{ number_format($producto->precio, 2) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="{{ $producto->existencias <= ($producto->stock_minimo ?? 5) ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }} px-2 py-1 rounded text-xs font-bold">
                            {{ $producto->existencias }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('gerente.inventario.edit', $producto) }}" class="text-blue-600 hover:text-blue-900 font-bold transition">
                                Editar
                            </a>
                            <form action="{{ route('gerente.inventario.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Caso cuando no hay productos --}}
        @if($productos->isEmpty())
            <div class="p-8 text-center text-gray-500 italic">
                No hay productos registrados en el inventario.
            </div>
        @endif
    </div>
</div>
@endsection