<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    // Especificar la tabla asociada al modelo
    protected $table = '_ventas_detalles';

    // Definir la clave primaria de la tabla
    protected $primaryKey = 'id_detalle';

    // Permitir asignación masiva en estos campos
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'descuento',
        'igv',
        'subtotal',
        'cambio'
    ];

    // Definir las relaciones con otras tablas

    /**
     * Relación con la tabla '_gestionar_ventas'
     * Un detalle de venta pertenece a una venta.
     */
    public function venta()
    {
        return $this->belongsTo(VentaDetalle::class, 'id_venta', 'id_venta');
    }

    /**
     * Relación con la tabla 'productos'
     * Un detalle de venta pertenece a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * Obtener el subtotal con el IGV incluido
     * @return float
     */
    public function getSubtotalWithIgvAttribute()
    {
        return $this->subtotal + $this->igv;
    }
}
