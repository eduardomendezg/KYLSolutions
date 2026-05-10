@extends('layouts.templates.sidebar')

@section('title', 'Actualizar Datos Cliente')

@section('content')

{{-- Botón Atrás --}}
<div class="auth-wrapper mb-4">
    <a href="{{ route('gerente.clientes.index') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        atrás
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-600">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Actualizar Datos del Cliente</h2>
            <p class="text-sm text-gray-500 font-medium">Modifica la información necesaria para: <span class="text-blue-600">{{ $cliente->nombre }} {{ $cliente->apellido }}</span></p>
        </div>

        <form action="{{ route('gerente.clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nombre --}}
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>

                {{-- Apellido --}}
                <div>
                    <label for="apellido" class="block text-sm font-semibold text-gray-700">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $cliente->apellido) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>

                {{-- Correo Electrónico --}}
                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="ejemplo@correo.com">
                </div>

                {{-- Documento de Identidad --}}
                <div>
                    <label for="documento_identidad" class="block text-sm font-semibold text-gray-700">Documento (DUI o NIT)</label>
                    <input type="text" id="documento_identidad" name="documento_identidad" value="{{ old('documento_identidad', $cliente->documento_identidad) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition bg-gray-50" placeholder="00000000-0">
                </div>

                {{-- Teléfono --}}
                <div>
                    <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono de Contacto</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="7777-7777">
                </div>

                {{-- Dirección --}}
                <div class="md:col-span-2">
                    <label for="direccion" class="block text-sm font-semibold text-gray-700">Dirección Residencial</label>
                    <textarea id="direccion" name="direccion" rows="3" 
                              class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('direccion', $cliente->direccion) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-4 border-t pt-6">
                <a href="{{ route('gerente.clientes.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white font-bold py-2.5 px-8 rounded-md hover:bg-blue-700 shadow-lg shadow-blue-200 transition transform active:scale-95">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection