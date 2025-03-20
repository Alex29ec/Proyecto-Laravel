<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'capacidad', 'disponible'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
