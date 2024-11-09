<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = '_ventas_detalles';

    // Definir los campos que son asignables masivamente
    protected $fillable = [
        'id_venta',
        'id_producto',
        'id_cliente',
        'cantidad',
        'precio_unitario',
        'descuento',
        'igv',
        'subtotal',
        'cambio',
    ];

    // Relación con la tabla 'Venta'
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    // Relación con la tabla 'Producto'
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    // Relación con la tabla 'Cliente'
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Definir los atributos con valores por defecto (si es necesario)
    protected $attributes = [
        'descuento' => 0,
        'igv' => 0,
        'cambio' => 0,
    ];
}
