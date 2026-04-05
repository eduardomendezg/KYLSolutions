@extends('layouts.templates.sellertem')
@section('title', 'Inventario de Productos')
<br><br>
@section('content')
    <h1>Inventario de Productos</h1><br>
    <a href="{{ route('crear') }}" >
        Nuevo Producto
    </a>
    <br>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default max-w-3xl mx-auto">
    <table class="w-full text-sm text-center rtl:text-right text-body">
        <thead class="bg-neutral-secondary-soft border-b border-default">
            <tr>
                <th scope="col" class="px-6 py-2 font-medium">
                    Producto
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Sock
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Precio
                </th>
                <th scope="col" class="px-6 py-2 font-medium">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
             @foreach($productos as $producto)
            <tr class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default">
                <td class="px-4 py-2">
                    {{ $producto->nombre }}
                </td>
                <td class="px-4 py-2">
                    {{ $producto->stock }}
                </td>
                <td class="px-4 py-2">
                   ${{ $producto->precio }}
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('gerente.inventario.edit', $producto) }}" class="font-medium text-fg-brand hover:underline">Edit</a>
                    <form action="{{ route('gerente.inventario.destroy', $producto) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
</div>

@endsection
