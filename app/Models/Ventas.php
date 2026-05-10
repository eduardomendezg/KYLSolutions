<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
protected $fillable = [
        'cliente_id',
        'user_id',
        'subtotal',
        'impuestos', 
        'total',
        'metodo_pago',
        'pago_con',
        'cambio',
        'referencia_pago',
        'numero_ticket',
        'factura_enviada'
    ];
    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }
   
    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
