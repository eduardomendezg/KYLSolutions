<?php

namespace App\Mail;

use App\Models\Ventas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaVenta extends Mailable
{
    use Queueable, SerializesModels;

    public $venta;

    public function __construct(Ventas $venta)
    {
        // Se pasa la venta cargando sus relaciones
        $this->venta = $venta->load(['detalles.producto', 'cliente']);
    }

    public function build()
    {
        $pdf = Pdf::loadView('vendedor.factura-dte', ['venta' => $this->venta])
                  ->setPaper('letter', 'portrait') // Tamaño carta
                  ->output();
        return $this->view('emails.factura')
                    ->subject('Tu Factura Electrónica - KYL Solutions')
                    ->attachData($pdf, "DTE_{$this->venta->numero_ticket}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}