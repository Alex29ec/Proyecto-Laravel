<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'nombre_cliente',
        'nombre_tatuador',
        'imagen',
        'fecha',
        'hora',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'string',
    ];
}