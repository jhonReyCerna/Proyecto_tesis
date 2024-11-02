<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id_compra'; 
    protected $dates = ['fecha'];
    protected $fillable = [
        'producto_id',
        'proveedor_id',
        'cantidad',
        'fecha',
        'almacen_id',
        'precio_unitario',
        'total',
        'descripcion',
        'estado',
    ];

 
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', 'id_proveedor');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id', 'id_almacen');
    }
}
