<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = [
        'id_cliente',
        'totalPagar',
        'fecha_venta',
        'estado'
    ];

    // Convertir automáticamente 'fecha_venta' a un objeto Carbon
    protected $dates = ['fecha_venta']; // Esto le dice a Laravel que lo maneje como una fecha

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Relación con el modelo VentaDetalle
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'id_venta');
    }
}
