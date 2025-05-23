<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory; // permitir crear instancias con datos de prueba facilmente (seeders)

    protected $fillable = [ // defino los campos que se van a generar al crear una película
        'title',
        'short_description',
        'description',
        'director',
        'genre',
        'duration',
        'classification',
        'language',
        'release_date',
        'rating',
        'poster_image',
        'cover_image',
        'cast'
    ];

    protected $casts = [ // convierto los campos cuando se recuperan de la BD
        'cast' => 'array', // por ejemplo, cast es un json y lo convierto a array
        'release_date' => 'date',
        'rating' => 'float',
        'duration' => 'integer',
    ];

    public function showtimes()// Define una relación: "una película tiene muchos horarios"
    {
        return $this->hasMany(Showtime::class);
    }

    public function bookings()// Define una relación: "una película tiene muchas reservas" a través de los horarios
    {
        return $this->hasManyThrough(Booking::class, Showtime::class);
    }
}