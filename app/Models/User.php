<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [ // Para crear o actualizar usuarios con estos atributos
        'name',
        'email',
        'password',
    ];

    protected $hidden = [ // Oculta estos campos al convertir el modelo a JSON
        'password',
        'remember_token',
    ];

    protected $casts = [ // convertimo email_verified_at a objeto
        'email_verified_at' => 'datetime',
    ];

    public function bookings() // un usuario puede tener muchas reservas
    {
        return $this->hasMany(Booking::class);
    }
}