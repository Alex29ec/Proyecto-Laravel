<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = [
        'id_cliente',
        'id_tatuador',
        'image',
        'date',
        'hour',
    ];
    public function tatuador()
    {
        return $this->belongsTo(Tatuador::class, 'id_tatuador');
    }
    
    protected $casts = [
        'fecha' => 'date',
        'hora' => 'string',
    ];
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
}