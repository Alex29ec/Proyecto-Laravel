<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['ruta', 'idtatuador', 'estilo', 'zona', 'tamano'];

    public function tatuador()
    {
        return $this->belongsTo(Tatuador::class, 'idtatuador');
    }
}
