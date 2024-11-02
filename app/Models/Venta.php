<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'ventas';

    // Llave primaria
    protected $primaryKey = 'id_venta';

    // Campos que pueden ser rellenados
    protected $fillable = [
        'producto_id',
        'cliente_id',
        'cantidad',
        'fecha',
        'subtotal',
        'impuesto',
        'descuento',
        'total',
        'metodo_pago',
        'estado',
    ];

    // Definir las relaciones con otros modelos

    /**
     * Relación con el modelo Producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }

    /**
     * Relación con el modelo Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }
}
