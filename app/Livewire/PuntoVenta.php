<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Clientes;
use App\Models\Ventas;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaVenta;
use Illuminate\Support\Facades\Auth;

class PuntoVenta extends Component
{
    // Propiedades de búsqueda
    public $busqueda = '';
    public $busquedaCliente = '';
    
    // Estado de la Venta
    public $carrito = [];
    public $metodoPago = 'Efectivo';
    public $bancoTarjeta = '';
    public $referenciaTarjeta = '';
    public $efectivoRecibido = 0;
    public $clienteSeleccionado = null;
    
    // Control de Interfaz (Modales)
    public $modalAbierto = false;
    public $mostrarModalCobro = false;

    /**
     * 1. BÚSQUEDA DINÁMICA DE PRODUCTOS
     * Se activa automáticamente cuando escribes en el visual.
     */
    #[Computed]
    public function resultados()
    {
        if (strlen($this->busqueda) < 2) return [];

        return Producto::where(function($query) {
            $query->where('nombre', 'like', "%{$this->busqueda}%")
                  ->orWhere('codigo', 'like', "%{$this->busqueda}%");
        })
        ->where('existencias', '>', 0)
        ->limit(6)
        ->get();
    }

    /**
     * 2. BÚSQUEDA DE CLIENTES PARA EL MODAL
     */
    #[Computed]
    public function clientes()
    {
        if (strlen($this->busquedaCliente) < 2) return [];

        return Clientes::where('nombre', 'like', "%{$this->busquedaCliente}%")
            ->orWhere('apellido', 'like', "%{$this->busquedaCliente}%")
            ->orWhere('documento_identidad', 'like', "%{$this->busquedaCliente}%")
            ->get();
    }

    /**
     * 3. LÓGICA DEL CARRITO
     */
    public function agregarProducto($productoId)
    {
        $producto = Producto::find($productoId);

        if (isset($this->carrito[$productoId])) {
            $this->carrito[$productoId]['cantidad']++;
        } else {
            $this->carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'codigo' => $producto->codigo,
                'precio' => $producto->precio,
                'cantidad' => 1
            ];
        }
        $this->busqueda = ''; // Limpia el buscador para la siguiente entrada
    }

    public function aumentarCantidad($id) { $this->carrito[$id]['cantidad']++; }

    public function disminuirCantidad($id) {
        if ($this->carrito[$id]['cantidad'] > 1) {
            $this->carrito[$id]['cantidad']--;
        } else {
            $this->quitarProducto($id);
        }
    }

    public function quitarProducto($id) { unset($this->carrito[$id]); }

    /**
     * 4. CÁLCULOS DE DINERO
     */
    #[Computed]
    public function subtotal() {
        return collect($this->carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);
    }
    #[Computed]
    public function iva() {
        return $this->subtotal * 0.13;
    }

    #[Computed]
    public function total() {
        return $this->subtotal + $this->iva;; 
    }

    #[Computed]
    public function cambio() {
        $cambio = (float)$this->efectivoRecibido - $this->total;
        return $cambio > 0 ? $cambio : 0;
    }

    /**
     * 5. GESTIÓN DE CLIENTES
     */
    public function seleccionarCliente($id) {
        $this->clienteSeleccionado = Clientes::find($id);
        $this->modalAbierto = false;
        $this->busquedaCliente = '';
    }

    public function limpiarCliente() { $this->clienteSeleccionado = null; }


    /**
     * 6. PROCESO FINAL DE VENTA Y FACTURACIÓN
     */
    public function abrirModalCobro() {
        if (empty($this->carrito)) return;
        $this->efectivoRecibido = null;
        $this->mostrarModalCobro = true;
    }

public function guardarVenta()
{
    // 1. Validaciones iniciales según el método de pago
    if ($this->metodoPago === 'Efectivo') {
        if ($this->efectivoRecibido < $this->total) {
            $this->addError('efectivoRecibido', 'El monto es insuficiente.');
            return;
        }
    }

    if ($this->metodoPago === 'Tarjeta') {
        if (empty($this->bancoTarjeta) || empty($this->referenciaTarjeta)) {
            session()->flash('error', 'Debe completar los datos del voucher (Banco y Referencia).');
            return;
        }
    }

    try {
        $ventaId = DB::transaction(function () {
            // 2. Generar número de ticket único 
            $ultimoId = Ventas::max('id') ?? 0;
            $numeroTicket = 'V-' . str_pad($ultimoId + 1, 6, '0', STR_PAD_LEFT);

            // 3. Crear registro de venta
            $venta = Ventas::create([
                'user_id'         => Auth::id(),
                'cliente_id'      => $this->clienteSeleccionado?->id,
                'subtotal'        => $this->subtotal,
                'impuestos'       => $this->iva,
                'total'           => $this->total,
                'metodo_pago'     => $this->metodoPago,
                'pago_con'        => $this->metodoPago === 'Efectivo' ? $this->efectivoRecibido : $this->total,
                'cambio'          => $this->metodoPago === 'Efectivo' ? $this->cambio : 0.00,
                'referencia_pago' => $this->metodoPago === 'Tarjeta' ? "{$this->bancoTarjeta}: {$this->referenciaTarjeta}" : null,
                
                'numero_ticket'   => $numeroTicket,
                'factura_enviada' => false,
            ]);

            // 4. Guardar detalles y descontar stock
            foreach ($this->carrito as $item) {
                DetalleVenta::create([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $item['id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal'        => $item['precio'] * $item['cantidad'],
                ]);

                Producto::find($item['id'])->decrement('existencias', $item['cantidad']);
            }

            return $venta->id;
        });

        // 5. Envío de Email solo si tiene email si no agregó cliente siempre se guarda la venta pero no se envía el mail 
        $ventaFinal = Ventas::find($ventaId);
        if ($this->clienteSeleccionado && $this->clienteSeleccionado->email) {
            try {
                Mail::to($this->clienteSeleccionado->email)->send(new FacturaVenta($ventaFinal));
                $ventaFinal->update(['factura_enviada' => true]);
            } catch (\Exception $e) {
                // No detenemos la venta si falla el mail, solo notificamos
            }
        }

        // 6. Limpiar todo para la siguiente venta
        $this->reset(['carrito', 'efectivoRecibido', 'bancoTarjeta', 'referenciaTarjeta', 'mostrarModalCobro', 'clienteSeleccionado']);
       

        session()->flash('success', 'Venta realizada con éxito. Ticket: ' . $ventaFinal->numero_ticket);

    } catch (\Exception $e) {
        session()->flash('error', 'Error crítico: ' . $e->getMessage());
    }
}

    public function render()
    {
        return view('livewire.vendedor.punto-venta');
    }
}