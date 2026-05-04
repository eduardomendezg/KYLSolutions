@extends('layouts.templates.sellertem')

@section('content')

<div class="auth-wrapper mb-4">
    <a href="{{ route('gerente.dashboard') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        atrás
    </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Nueva Categoría</h2>
        <form action="{{ route('gerente.categorias.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. Lácteos" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Descripción (Opcional)</label>
                <textarea name="descripcion" rows="3" class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Detalles de la categoría..."></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition">
                Guardar Categoría
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Categorías Registradas</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-3 text-sm font-bold text-gray-600 uppercase">ID</th>
                        <th class="p-3 text-sm font-bold text-gray-600 uppercase">Nombre</th>
                        <th class="p-3 text-sm font-bold text-gray-600 uppercase">Descripción</th>
                        <th class="p-3 text-sm font-bold text-gray-600 uppercase text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $cat)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3 text-gray-700">{{ $cat->id }}</td>
                        <td class="p-3 font-semibold text-gray-800">{{ $cat->nombre }}</td>
                        <td class="p-3 text-gray-600 text-sm">{{ $cat->descripcion ?? 'N/A' }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('gerente.categorias.destroy', $cat->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm" onclick="return confirm('¿Seguro que desea eliminar esta categoría?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500 italic">No hay categorías registradas aún.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection