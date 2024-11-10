<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    protected $table = 'ventas_detalles';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'id_cliente',
        'cantidad',
        'precio_unitario',
        'descuento',
        'igv',
        'subtotal',
        'cambio'
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
