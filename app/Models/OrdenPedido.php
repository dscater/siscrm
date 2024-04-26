<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "nro",
        "configuracion_pago_id",
        "celular",
        "comprobante",
        "lat",
        "lng",
        "total",
        "estado",
        "fecha_registro",
    ];

    protected $appends = ["fecha_registro_t"];

    public function getFechaRegistroT()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }

    public function configuracion_pago()
    {
        return $this->belongsTo(ConfiguracionPago::class, 'configuracion_pago_id');
    }
}
