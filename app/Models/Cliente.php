<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'dni',
        'fecha_nacimiento',
        'genero',
        'activo',
        'tipo_cliente',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'fecha_nacimiento',
    ];
}
