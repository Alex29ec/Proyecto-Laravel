<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mesa_id', 'num_personas', 'fecha_hora', 'confirmada'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'reserva_menu')->withPivot('cantidad');
    }
    
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
}

