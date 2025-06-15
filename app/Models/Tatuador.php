<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Tatuador extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'specialties', 'password','photo','remember_token'];
    protected $table = 'tatuadors';
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_tatuador');
    }
    public function fotos()
{
    return $this->hasMany(Photo::class, 'idtatuador');
}
 protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
