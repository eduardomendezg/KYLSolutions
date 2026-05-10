<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'documento_identidad',
        'telefono',
        'direccion'
    ];
    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'cliente_id');
    }
}