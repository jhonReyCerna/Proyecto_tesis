<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si no es el plural del nombre del modelo
    protected $table = 'ventas';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'id_venta';

    // Especificar los campos que se pueden asignar masivamente (mass assignable)
    protected $fillable = [
        'id_cliente',
        'totalPagar',
        'fecha',
        'estado',
    ];

    // Deshabilitar las marcas de tiempo si no se usan
    public $timestamps = true;

    // Definir la relación con el modelo Cliente (relación de uno a muchos)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
