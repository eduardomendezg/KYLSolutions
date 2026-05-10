<div class="animate-fade-in space-y-5">
    <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl flex items-center gap-3">
        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
        </svg>
        <p class="text-sm text-blue-800 font-medium">Capture los datos del voucher de la terminal física.</p>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Banco emisor de la terminal</label>
            <select wire:model.live="bancoTarjeta" 
                class="w-full border-2 border-gray-100 rounded-xl p-3 outline-none focus:border-blue-500 font-bold bg-white text-gray-700">
                <option value="">Seleccionar Banco...</option>
                <option value="BAC">BAC Credomatic</option>
                <option value="CUSCATLAN">Banco Cuscatlán</option>
                <option value="AGRICOLA">Banco Agrícola</option>
                <option value="DAVIVIENDA">Davivienda</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Número de Referencia (Voucher)</label>
            <div class="relative flex items-center">
                <input wire:model.live="referenciaTarjeta" type="text" placeholder="Ej: 000123"
                    class="w-full border-2 border-gray-100 rounded-xl p-4 pl-12 text-xl font-black text-navy outline-none focus:border-blue-500 transition shadow-inner">
                <svg class="w-6 h-6 text-gray-300 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2"/>
                </svg>
            </div>
            @error('referenciaTarjeta') <span class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</span> @enderror
        </div>
    </div>
</div>