<!DOCTYPE html>
<html>
<head>
    <title>DTE - {{ $venta->numero_ticket }}</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: 'Courier', 'Helvetica', sans-serif; color: #1a1a1a; line-height: 1.4; font-size: 10px; }
        
        .header-table { width: 100%; border-bottom: 2px solid #333; margin-bottom: 15px; }
        .dte-box { border: 2px solid #333; padding: 10px; text-align: center; background: #f4f4f4; }
        
        .seccion-titulo { background: #333; color: white; padding: 4px 8px; font-weight: bold; text-transform: uppercase; margin-top: 15px; }
        .datos-cuadro { border: 1px solid #ccc; padding: 8px; margin-bottom: 10px; }

        table.productos { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.productos th { border-bottom: 2px solid #333; padding: 6px; text-align: left; background: #eee; }
        table.productos td { padding: 6px; border-bottom: 1px solid #eee; }

        .totales-table { width: 100%; margin-top: 15px; border-top: 2px solid #333; }
        .totales-table td { padding: 4px; }

        .sello-digital { 
            margin-top: 20px; 
            padding: 10px; 
            border: 1px dashed #999; 
            background: #fafafa; 
            font-family: monospace; 
            font-size: 8px; 
            color: #555;
            word-break: break-all;
        }

        .barcode-sim {
            text-align: center;
            font-size: 24px;
            letter-spacing: -2px;
            margin: 10px 0;
            font-family: 'Courier';
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="width: 60%;">
                <h1 style="margin:0; font-size: 18px;">KYL SOLUTIONS </h1>
                <p style="margin:2px 0">
                    <strong>NIT:</strong> 0614-123456-101-5<br>
                    <strong>NRC:</strong> 234567-8<br>
                    <strong>Matriz:</strong> San Miguel, El Salvador.<br>
                    <strong>Contacto:</strong> facturas@kylsolutions.com
                </p>
            </td>
            <td style="width: 40%;">
                <div class="dte-box">
                    <span style="font-size: 11px; font-weight: bold;">DOCUMENTO TRIBUTARIO ELECTRÓNICO</span><br>
                    <span style="font-size: 14px; color: #000;">FACTURA ELECTRÓNICA</span><br>
                    <span style="font-size: 16px; font-weight: bold;">{{ $venta->numero_ticket }}</span>
                </div>
            </td>
        </tr>
    </table>

    <div class="seccion-titulo">Información del Receptor</div>
    <div class="datos-cuadro">
        <table style="width: 100%;">
            <tr>
                <td><strong>Nombre:</strong> {{ $venta->cliente->nombre ?? 'Consumidor Final' }}</td>
                <td><strong>Fecha/Hora:</strong> {{ $venta->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <td><strong>Documento:</strong> {{ $venta->cliente->documento_identidad ?? 'N/A' }}</td>
                <td><strong>Lugar:</strong> San Miguel, El Salvador</td>
            </tr>
        </table>
    </div>

    <table class="productos">
        <thead>
            <tr>
                <th style="width: 10%;">CANT</th>
                <th style="width: 50%;">DESCRIPCIÓN</th>
                <th style="width: 20%;">P. UNIT</th>
                <th style="width: 20%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
            <tr>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totales-table">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <div style="margin-top: 10px;">
                    <strong>SON:</strong> ${{ number_format($venta->total, 2) }} DÓLARES<br>
                    
                    <strong>MÉTODO DE PAGO:</strong> {{ strtoupper($venta->metodo_pago) }}
                </div>
            </td>
            <td style="width: 40%;">
                <table style="width: 100%; text-align: right;">
                    <tr>
                        <td>SUBTOTAL:</td>
                        <td>${{ number_format($venta->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td>IVA (13%):</td>
                        <td>${{ number_format($venta->impuestos, 2) }}</td>
                    </tr>
                    <tr style="font-size: 14px; font-weight: bold;">
                        <td>TOTAL:</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="sello-digital">
        <strong>FIRMA ELECTRÓNICA Y SELLO DIGITAL DE HACIENDA:</strong><br>
        COD-GEN: {{ strtoupper(bin2hex(random_bytes(16))) }}-{{ $venta->id }}<br>
        SELLO: {{ hash('sha512', $venta->numero_ticket . $venta->created_at) }}<br>
        CERTIFICADO: 000000-000000-{{ date('Y') }}-KYL-PROD
    </div>

    <div class="footer" style="text-align: center; margin-top: 20px; color: #666; font-size: 8px;">
        <div class="barcode-sim">|||| || ||||| ||| | |||| || ||||| |||</div>
        Este es un Documento Tributario Electrónico (DTE) emitido bajo la normativa de facturación electrónica vigente.
        <br>Representación gráfica para uso exclusivo del receptor.
    </div>

</body>
</html>