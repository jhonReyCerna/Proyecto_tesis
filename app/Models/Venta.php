<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['id_cliente', 'fecha', 'totalPagar', 'estado'];

    // Relación muchos a muchos con productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_producto')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
