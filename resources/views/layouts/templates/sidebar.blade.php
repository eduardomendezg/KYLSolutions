<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - POS')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-neutral-50">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 w-64 h-screen bg-blue-900 text-white">
        <!-- Logo -->
    <div class="p-4 border-b border-white">
        <div class="flex justify-center">
            <img src="{{ asset('/img/logo png.png') }}" class="h-16 w-auto" alt="Logo">
            
        </div>
    </div>
        <!-- Menú -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('gerente.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-blue-800">Ventas</a>
                </li>
                <li>
                    <a href="{{ route('gerente.inventario.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Productos</a>
                </li>
                <li>
                    <a href="{{ route('gerente.clientes.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Clientes</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-blue-800">Reportes</a>
                </li>

            </ul>
        </nav>

        <!-- Usuario -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
            <div class="flex items-center gap-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 bg-white border border-blue-200 text-blue-600 hover:bg-blue-50 font-bold py-2 px-4 rounded-xl transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
            </div>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="ml-64 p-6">
        @yield('content')
    </main>

</body>
</html>