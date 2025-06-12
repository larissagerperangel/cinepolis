<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory; // permitir crear instancias con datos de prueba facilmente (seeders)

    protected $fillable = [ // defino los campos que se van a generar al crear una reserva
        'user_id',
        'showtime_id',
        'seats',
        'total_price',
        'payment_method',
        'status',
        'customer_name',    
        'customer_email',
    ];

    protected $casts = [ // convierto los campos cuando se recuperan de la BD
        'seats' => 'array',
        'total_price' => 'float',
    ];

    public function user() // Define una relación: "una reserva pertenece a un usuario"
    {
        return $this->belongsTo(User::class);
    }

    public function showtime() // Define una relación: "una reserva solo tiene un horario"
    {
        return $this->belongsTo(Showtime::class);
    }

     public function getSeatNumbersAttribute() //para evitar error si no hay asientos
    {
        return $this->seats ?? [];
    }
}