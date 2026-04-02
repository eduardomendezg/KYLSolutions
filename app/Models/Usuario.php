<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'codigo',
        'nombre',
        'apellido',
        'email',
        'password',
        'rol_id',
    ];

    //oculta la contra en las consultas de mysql
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function roles(): BelongsTo
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }
}
