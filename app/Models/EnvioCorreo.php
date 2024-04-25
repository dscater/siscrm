<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioCorreo extends Model
{
    use HasFactory;

    protected $appends = [
        "host",
        "puerto",
        "encriptado",
        "email",
        "nombre",
        "password",
        "driver",
    ];
}
