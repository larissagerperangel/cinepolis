<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory; // permitir crear instancias con datos de prueba facilmente (seeders)

    protected $fillable = [ // defino los campos que se van a tener los horarios de las películas
        'movie_id',
        'time',
        'date',
        'room',
        'available_seats',
    ];

    protected $casts = [ // convierto los campos cuando se recuperan de la BD
        'date' => 'date',
        'available_seats' => 'array',
    ];

    // MÉTODO PARA OBTENER AVAILABLE_SEATS COMO ARRAY SIEMPRE
    public function getAvailableSeatsAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        if (is_array($value)) {
            return $value;
        }
        
        return [];
    }

    public function movie()// Define una relación: "un horario pertenece a una película"
    {
        return $this->belongsTo(Movie::class);
    }

    public function bookings()// Define una relación: " un horario tiene muchas reservas"
    {
        return $this->hasMany(Booking::class);
    }
}