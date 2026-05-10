<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $fillable = [
    'venta_id',
    'producto_id',
    'cantidad',
    'precio_unitario',
    'subtotal',
    'descuento',
    'subtotal'];

   
    public function venta()
    {
        return $this->belongsTo(Ventas::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
