<div class="min-h-screen bg-gray-200 font-sans">
    <style>
        .bg-navy { background-color: #001b48; }
        .text-navy { color: #001b48; }
        @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
    </style>

    <header class="bg-white shadow-sm p-4 flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('/img/logo png.png') }}" alt="KYL Solutions" class="h-12">
        </div>
        
<div class="relative group inline-block">
    
    <div class="flex items-center bg-gray-50 border rounded-full px-4 py-2 shadow-sm cursor-pointer group-hover:bg-gray-100 transition">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-2 border border-blue-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" />
            </svg>
        </div>
        <span class="font-bold text-gray-700 text-sm">{{ auth()->user()->codigo }}</span>
    </div>

    <div class="absolute right-0 hidden group-hover:block w-48 pt-2 z-50">
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-bold transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
    </header>

    <main class="container mx-auto px-4 pb-8">
        <div class="grid grid-cols-12 gap-6">
            
            <div class="col-span-12 lg:col-span-8">
                
                <div class="bg-white p-4 rounded-xl shadow-sm mb-6 border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="flex-1 flex items-center bg-gray-100 rounded-lg px-3 focus-within:ring-2 focus-within:ring-blue-400 transition-all">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"></path>
                            </svg>
                            <input wire:model.live="busqueda" type="text" 
                                placeholder="Escribe el nombre o escanea el código..." 
                                class="w-full bg-transparent border-none p-3 outline-none focus:ring-0 text-gray-700 font-medium">
                        </div>
                    </div>

                    @if(count($this->resultados) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 animate-fade-in">
                        @foreach($this->resultados as $prod)
                        <button wire:click="agregarProducto({{ $prod->id }})" 
                            class="flex justify-between items-center bg-blue-50 p-4 rounded-xl hover:bg-blue-100 border border-blue-200 transition group">
                            <div class="text-left">
                                <span class="block font-bold text-gray-700 group-hover:text-blue-800">{{ $prod->nombre }}</span>
                                <span class="text-xs text-gray-400 font-mono">{{ $prod->codigo }}</span>
                            </div>
                            <span class="text-blue-600 font-black text-lg">${{ number_format($prod->precio, 2) }}</span>
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex items-center justify-between border-l-4 border-blue-500 border border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-blue-50 rounded-full text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Cliente de la venta</p>
                            <h3 class="font-bold text-gray-800 text-lg">
                                {{ $clienteSeleccionado ? ($clienteSeleccionado->nombre . ' ' . $clienteSeleccionado->apellido) : 'Venta General (Sin Afiliar)' }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="$set('modalAbierto', true)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold transition text-sm">
                            Buscar Cliente
                        </button>
                        @if($clienteSeleccionado)
                            <button wire:click="limpiarCliente" type="button" class="text-red-500 font-bold px-2 italic hover:underline text-sm">
                                Quitar
                            </button>
                        @endif
                    </div>
                </div>

                @if(empty($carrito))
                <div class="bg-white rounded-xl shadow-sm p-8 text-center border-2 border-dashed border-gray-200 min-h-[400px] flex flex-col justify-center items-center">
                    <svg class="w-20 h-20 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2"></path>
                    </svg>
                    <p class="text-gray-400 font-medium text-lg">Escanea un producto o usa el buscador para comenzar</p>
                </div>
                @endif
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-[700px] sticky top-4 border border-gray-100">
                    <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-700 flex items-center gap-2 text-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2"></path>
                            </svg>
                            Orden Actual
                        </h3>
                        <button wire:click="limpiarVenta" class="text-red-500 font-bold text-xs hover:bg-red-50 px-2 py-1 rounded transition uppercase">Limpiar</button>
                    </div>

                    <div class="flex-1 overflow-y-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 text-[10px] uppercase font-bold text-gray-500 tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 uppercase">Producto</th>
                                    <th class="px-4 py-2 text-right uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-medium">
                                @foreach($carrito as $id => $item)
                                <tr class="group hover:bg-gray-50 transition">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="max-w-[150px]">
                                                <span class="block font-bold text-sm text-gray-800 truncate">{{ $item['nombre'] }}</span>
                                                <span class="text-[10px] text-gray-400 font-mono">
                                                    {{ $item['cantidad'] }} x ${{ number_format($item['precio'], 2) }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1 ml-4 opacity-0 group-hover:opacity-100 transition">
                                                <button wire:click="disminuirCantidad({{ $id }})" class="p-1 rounded-md bg-white border text-gray-500 hover:text-red-600 transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4" stroke-width="2"/></svg>
                                                </button>
                                                <button wire:click="aumentarCantidad({{ $id }})" class="p-1 rounded-md bg-white border text-gray-500 hover:text-green-600 transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <span class="font-bold text-blue-600">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                            <button wire:click="quitarProducto({{ $id }})" class="text-gray-300 hover:text-red-600 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 bg-gray-50 border-t mt-auto shadow-[0_-4px_10px_rgba(0,0,0,0.02)]">
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600 font-medium">
                                <span>Subtotal</span>
                                <span class="font-mono font-bold">${{ number_format($this->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>IVA (13%)</span>
                                <span class="font-bold">${{ number_format($this->iva, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                                <span class="text-2xl font-black text-gray-800 uppercase tracking-tighter">TOTAL</span>
                                <span class="text-3xl font-black text-blue-700 font-mono tracking-tighter">${{ number_format($this->total, 2) }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <button wire:click="$set('metodoPago', 'Efectivo')" 
                                class="border-2 py-3 rounded-xl font-bold transition text-xs uppercase tracking-widest {{ $metodoPago == 'Efectivo' ? 'border-blue-500 bg-white text-blue-600 shadow-sm' : 'border-gray-200 text-gray-400 bg-transparent hover:bg-gray-100' }}">
                                Efectivo
                            </button>
                            <button wire:click="$set('metodoPago', 'Tarjeta')" 
                                class="border-2 py-3 rounded-xl font-bold transition text-xs uppercase tracking-widest {{ $metodoPago == 'Tarjeta' ? 'border-blue-500 bg-white text-blue-600 shadow-sm' : 'border-gray-200 text-gray-400 bg-transparent hover:bg-gray-100' }}">
                                Tarjeta
                            </button>
                        </div>

                        <button wire:click="abrirModalCobro" 
                            @if(empty($carrito)) disabled @endif
                            class="w-full bg-navy text-white py-5 rounded-2xl font-black text-xl shadow-lg hover:bg-blue-900 transition active:scale-95 disabled:opacity-50 uppercase tracking-widest">
                            Cobrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if($modalAbierto)
    <div class="fixed inset-0 bg-navy bg-opacity-40 flex items-center justify-center p-4 backdrop-blur-sm z-50">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden animate-fade-in">
            <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800 uppercase text-xs tracking-widest">Buscar Cliente</h3>
                <button wire:click="$set('modalAbierto', false)" class="text-gray-400 hover:text-gray-800 text-xl">✕</button>
            </div>
            <div class="p-6">
                <input wire:model.live="busquedaCliente" type="text" placeholder="Escribe nombre o DUI..." 
                    class="w-full border-2 border-gray-100 rounded-xl p-3 mb-4 outline-none focus:border-blue-500 transition shadow-inner font-medium">
                <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                    @foreach($this->clientes as $cliente)
                    <div wire:click="seleccionarCliente({{ $cliente->id }})" 
                        class="p-3 border rounded-xl hover:bg-blue-50 cursor-pointer transition flex justify-between items-center group">
                        <div>
                            <p class="font-bold text-gray-700 group-hover:text-blue-700">{{ $cliente->nombre }} {{ $cliente->apellido }}</p>
                            <p class="text-xs text-gray-400">Doc: {{ $cliente->documento_identidad ?? 'N/A' }}</p>
                        </div>
                        <svg class="w-5 h-5 text-blue-500 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3"></path></svg>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

@if($mostrarModalCobro)
<div class="fixed inset-0 bg-navy bg-opacity-40 flex items-center justify-center p-4 backdrop-blur-sm z-50">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden animate-fade-in border border-white/20">
        
        <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 uppercase text-xs tracking-widest">Finalizar Transacción</h3>
            <button wire:click="$set('mostrarModalCobro', false)" class="text-gray-400 hover:text-gray-800 text-xl transition">✕</button>
        </div>
        
        <div class="p-8">
            <div class="text-center mb-8">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total a Pagar</p>
                <h2 class="text-5xl font-black text-navy font-mono tracking-tighter">${{ number_format($this->total, 2) }}</h2>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-6">
                <button wire:click="$set('metodoPago', 'Efectivo')" 
                    class="border-2 py-3 rounded-xl font-bold transition text-xs uppercase tracking-widest {{ $metodoPago == 'Efectivo' ? 'border-blue-500 bg-white text-blue-600 shadow-sm' : 'border-gray-200 text-gray-400 bg-transparent hover:bg-gray-100' }}">
                    Efectivo
                </button>
                <button wire:click="$set('metodoPago', 'Tarjeta')" 
                    class="border-2 py-3 rounded-xl font-bold transition text-xs uppercase tracking-widest {{ $metodoPago == 'Tarjeta' ? 'border-blue-500 bg-white text-blue-600 shadow-sm' : 'border-gray-200 text-gray-400 bg-transparent hover:bg-gray-100' }}">
                    Tarjeta
                </button>
            </div>

            <div class="min-h-[160px]">
                @if($metodoPago === 'Efectivo')
                    @include('livewire.vendedor.cobro-efectivo')
                @elseif($metodoPago === 'Tarjeta')
                    @include('livewire.vendedor.cobro-tarjeta')
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100 mt-4">
                <button wire:click="$set('mostrarModalCobro', false)" 
                    class="py-4 rounded-xl font-bold text-gray-400 hover:bg-gray-100 transition uppercase text-xs tracking-widest">
                    Cancelar
                </button>
                <button wire:click="guardarVenta" 
                    class="bg-navy text-white py-4 rounded-xl font-black text-lg shadow-lg hover:bg-blue-900 transition uppercase tracking-widest active:scale-95">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
@endif

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
             class="fixed bottom-6 right-6 bg-green-600 text-white px-8 py-4 rounded-2xl shadow-2xl animate-fade-in z-[60] font-bold">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3"></path></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="fixed bottom-6 right-6 bg-red-600 text-white px-8 py-4 rounded-2xl shadow-2xl animate-fade-in z-[60] font-bold">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"></path></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif


</div>