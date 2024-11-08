<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionarVenta extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si el nombre del modelo coincide con el de la tabla en plural)
    protected $table = '_gestionar_ventas';

    // Clave primaria personalizada
    protected $primaryKey = 'id_venta';

    // Indicar si la clave primaria es autoincremental
    public $incrementing = true;

    // Tipo de dato de la clave primaria
    protected $keyType = 'int';

    // Campos que pueden ser llenados de forma masiva
    protected $fillable = [
        'id_cliente',
        'totalPagar',
        'fecha',
        'estado',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
