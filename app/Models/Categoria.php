<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',

        ];

    public function productos() {
        return $this->hasMany(Producto::class);
    }
    
}