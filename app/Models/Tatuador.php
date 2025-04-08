<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tatuador extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'capacidad', 'disponible'];

    public function tatuador()
    {
        return $this->hasMany(Reserva::class);
    }
}
