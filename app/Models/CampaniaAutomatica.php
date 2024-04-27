<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaniaAutomatica extends Model
{
    use HasFactory;

    protected $fillable = [
        "campania_id",
        "tipo",
        "fecha_registro",
        "fecha_ini",
        "fecha_fin",
        "frecuencia",
    ];

    public function campania()
    {
        return $this->belongsTo(Campania::class, 'campania_id');
    }
}
