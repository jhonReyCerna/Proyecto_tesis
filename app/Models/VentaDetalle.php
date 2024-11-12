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
        'cantidad',
        'precio_unitario',
        'descuento',
        'igv',
        'subtotal',
        'cambio',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    
}

