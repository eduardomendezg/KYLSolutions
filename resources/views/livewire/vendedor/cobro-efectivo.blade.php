<div class="animate-fade-in">
    <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Efectivo Recibido</label>
    <div class="relative flex items-center">
        <span class="absolute left-4 text-2xl font-bold text-blue-600">$</span>
        <input wire:model.live="efectivoRecibido" type="number" step="0.01" autofocus
            class="w-full bg-blue-50 border-2 border-blue-100 rounded-2xl p-4 pl-10 text-3xl font-black text-blue-700 outline-none focus:border-blue-500 transition shadow-inner">
    </div>
     @error('efectivoRecibido') <span class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</span>
      @enderror
    <div class="bg-green-50 border-2 border-green-100 rounded-2xl p-4 mt-4 flex justify-between items-center">
        <span class="text-green-700 font-bold uppercase text-xs tracking-wider">Su Cambio:</span>
        <span class="text-3xl font-black text-green-600 font-mono">${{ number_format($this->cambio, 2) }}</span>
    </div>
    
</div>