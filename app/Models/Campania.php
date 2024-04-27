<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campania extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "fecha_ini",
        "fecha_fin",
        "tipo",
        "tipo_cliente",
        "descripcion",
        "fecha_registro",
    ];
}
