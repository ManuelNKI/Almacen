<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre', 'stock', 'precio'];
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_producto', 'id_producto');
    }
}
