<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'id_cliente';
    protected $fillable = ['cedula', 'nombre', 'apellido'];
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_ced', 'cedula');
    }
}
