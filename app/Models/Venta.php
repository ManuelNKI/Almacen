<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_ced', 'id_producto', 'cantidad'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_ced', 'cedula');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
