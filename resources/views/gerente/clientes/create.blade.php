@extends('layouts.templates.sidebar')

@section('title', 'Registrar Cliente')

@section('content')
    
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
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrar Nuevo Cliente</h2>        

            <form action="{{ route('gerente.clientes.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nombre --}}
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" 
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="Ej. Juan" required>
                    </div>

                    {{-- Apellido --}}
                    <div>
                        <label for="apellido" class="block text-sm font-semibold text-gray-700">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" 
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="Ej. Pérez" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                           placeholder="usuario@ejemplo.com" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    {{-- Documento de Identidad --}}
                    <div>
                        <label for="documento_identidad" class="block text-sm font-semibold text-gray-700">Documento (DUI/NIT):</label>
                        <input type="text" id="documento_identidad" name="documento_identidad" value="{{ old('documento_identidad') }}" 
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="00000000-0">
                    </div>

                    {{-- Teléfono --}}
                    <div>
                        <label for="telefono" class="block text-sm font-semibold text-gray-700">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" 
                               class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                               placeholder="7777-7777">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="direccion" class="block text-sm font-semibold text-gray-700">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3" 
                              class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('direccion') }}</textarea>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-md font-bold hover:bg-blue-700 shadow-sm transition">
                        Guardar Cliente
                    </button>
                    <a href="{{ route('gerente.clientes.index') }}" class="text-gray-500 hover:text-gray-700 transition font-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection