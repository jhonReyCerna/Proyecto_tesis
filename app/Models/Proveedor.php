<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'ruc',
    ];

    public $timestamps = true;
}
