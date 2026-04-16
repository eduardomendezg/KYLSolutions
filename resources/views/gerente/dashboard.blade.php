@extends('layouts.templates.sellertem') {{-- Asegúrate de usar tu plantilla base --}}

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6">
    
    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800">Panel de Control</h2>
            <p class="text-gray-500 font-medium">Bienvenido al sistema de gestión de KYL Solutions</p>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 bg-white border border-red-200 text-red-600 hover:bg-red-50 font-bold py-2 px-4 rounded-xl transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Cerrar Sesión
            </button>
        </form>
    </div>

    {{-- Tarjetas de Estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        {{-- Total Productos --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Total Productos</p>
                <p class="text-3xl font-black text-gray-800">{{ $conteoProductos }}</p>
            </div>
        </div>

        {{-- Alerta Stock --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-red-100 text-red-600 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Stock Bajo</p>
                <p class="text-3xl font-black text-gray-800">{{ $stockBajo }}</p>
            </div>
        </div>

        {{-- Categorías --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Categorías</p>
                <p class="text-3xl font-black text-gray-800">{{ $conteoCategorias }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Accesos Rápidos --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Acciones Rápidas
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('gerente.inventario.index') }}" class="group p-4 border border-gray-100 rounded-xl hover:bg-blue-600 hover:border-blue-600 transition duration-300">
                    <p class="font-bold text-gray-800 group-hover:text-white">Gestionar Inventario</p>
                    <p class="text-xs text-gray-500 group-hover:text-blue-100">Ver, editar y eliminar productos</p>
                </a>
                <a href="{{ route('gerente.categorias.index') }}" class="group p-4 border border-gray-100 rounded-xl hover:bg-gray-800 hover:border-gray-800 transition duration-300">
                    <p class="font-bold text-gray-800 group-hover:text-white">Gestionar Categorías</p>
                    <p class="text-xs text-gray-500 group-hover:text-gray-300">Organizar productos</p>
                </a>
            </div>
        </div>

        {{-- Tabla de Últimos Agregados --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Últimos Productos
            </h3>
            <ul class="divide-y divide-gray-50">
                @foreach($ultimosProductos as $prod)
                <li class="py-3 flex justify-between items-center">
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $prod->nombre }}</p>
                        <p class="text-xs text-gray-500">{{ $prod->codigo }}</p>
                    </div>
                    <span class="text-sm font-semibold text-blue-600">${{ number_format($prod->precio, 2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection