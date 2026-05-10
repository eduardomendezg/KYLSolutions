<div style="font-family: sans-serif; max-width: 600px; margin: auto; border: 1px solid #eee; padding: 20px;">
    <h2 style="color: #001b48;">¡Gracias por tu compra!</h2>
    <p>Hola <strong>{{ $venta->cliente->nombre }}</strong>,</p>
    <p>Adjuntamos el detalle de tu ticket <strong>{{ $venta->numero_ticket }}</strong>:</p>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f4f4f4;">
                <th style="padding: 10px; text-align: left;">Producto</th>
                <th style="padding: 10px; text-align: center;">Cant.</th>
                <th style="padding: 10px; text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $detalle->producto->nombre }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee; text-align: center;">{{ $detalle->cantidad }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee; text-align: right;">${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right; color: #2563eb;">Total Pagado: ${{ number_format($venta->total, 2) }}</h3>
    
    <p style="font-size: 12px; color: #777;">Emitido por KYL Solutions el {{ now()->format('d/m/Y \a \l\a\s H:i') }} horas</p>
</div>