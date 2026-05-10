@extends('layouts.templates.sidebar')

@section('title', 'Gestión de Clientes')

@section('content')
    {{-- Botón Volver (Mismo estilo que inventario) --}}
    <div class="auth-wrapper mb-4">
        <a href="{{ route('gerente.dashboard') }}" class="btn-volver flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            atrás
        </a>
    </div>

    <div class="max-w-6xl mx-auto">
        {{-- Contenedor Principal con Borde Azul Superior --}}
        <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-600">
            
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Listado de Clientes</h2>
                <a href="{{ route('gerente.clientes.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md font-bold hover:bg-blue-700 shadow-sm transition flex items-center gap-2">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo Cliente
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100 text-gray-600 uppercase text-xs">
                            <th class="py-3 px-4 font-semibold">Cliente</th>
                            <th class="py-3 px-4 font-semibold">DUI/NIT</th>
                            <th class="py-3 px-4 font-semibold">Contacto</th>
                            <th class="py-3 px-4 font-semibold">Dirección</th>
                            <th class="py-3 px-4 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($clientes as $cliente)
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-800">{{ $cliente->nombre }} {{ $cliente->apellido }}</div>
                                    <div class="text-xs text-gray-500">{{ $cliente->email ?? 'Sin correo' }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm font-mono">
                                        {{ $cliente->documento_identidad ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-sm italic text-gray-600">{{ $cliente->telefono ?? '---' }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="text-sm truncate w-40" title="{{ $cliente->direccion }}">
                                        {{ $cliente->direccion ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex justify-center gap-3">
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('gerente.clientes.edit', $cliente->id) }}" class="text-blue-600 hover:scale-110 transition">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 text-gray-500 rounded-full flex items-center justify-center mr-3.121 1.121 3 3 0 114.242 4.242L9.828 17.586a2 2 0 01-.828.414l-4 1 1-4a2 2 0 01.414-.828L15.414 2.586z"></path>
                                            </svg>
                                        </a>
                                        {{-- Botón Eliminar --}}
                                        <form action="{{ route('gerente.clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:scale-110 transition">
                                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m4-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection