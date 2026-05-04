<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
     'codigo', 
     'nombre', 
     'precio', 
     'existencias', 
     'stock_minimo', 
     'categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
