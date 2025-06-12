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

    // Método para obtener el reparto como ARRAY 
    public function getCastAttribute($value)
    {
        if (is_string($value)) {
            // Si es string, intentar decodificar JSON
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : explode(',', $value);
        }
        
        if (is_array($value)) {
            return $value;
        }
        
        // Si es null o vacío, devolver array vacío
        return [];
    }

    // Método para obtener la imagen de un actor
    public function getActorImage($actorName, $index = 0)
    {
        // Limpiar el nombre del actor para usarlo como nombre de archivo
        $cleanName = $this->cleanActorName($actorName);
        
        // Buscar imagen específica del actor 
        $specificImage = "images/cast/{$cleanName}.jpg";
        if (file_exists(public_path($specificImage))) {
            return asset($specificImage);
        }
        
        // Imagen por defecto
        return asset('images/cast/default-actor.jpg');
    }

    // Método para mipiar nombre del actor
    private function cleanActorName($name)
    {
        // Convertir a minúsculas
        $clean = strtolower($name);
        
        // Reemplazar caracteres especiales comunes
        $replacements = [
            'á' => 'a', 'à' => 'a', 'ä' => 'a', 'â' => 'a',
            'é' => 'e', 'è' => 'e', 'ë' => 'e', 'ê' => 'e',
            'í' => 'i', 'ì' => 'i', 'ï' => 'i', 'î' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ö' => 'o', 'ô' => 'o',
            'ú' => 'u', 'ù' => 'u', 'ü' => 'u', 'û' => 'u',
            'ñ' => 'n', 'ç' => 'c'
        ];
        
        $clean = str_replace(array_keys($replacements), array_values($replacements), $clean);
        
        // Reemplazar espacios y puntos por guiones
        $clean = preg_replace('/[\s\.]+/', '-', $clean);
        
        // Eliminar caracteres especiales excepto guiones
        $clean = preg_replace('/[^a-z0-9\-]/', '', $clean);
        
        // Eliminar guiones múltiples
        $clean = preg_replace('/-+/', '-', $clean);
        
        // Eliminar guiones al inicio y final
        return trim($clean, '-');
    }

    public function showtimes()// Define una relación: "una película tiene muchos horarios"
    {
        return $this->hasMany(Showtime::class);
    }

    public function bookings()// Define una relación: "una película tiene muchas reservas" a través de los horarios
    {
        return $this->hasManyThrough(Booking::class, Showtime::class);
    }
}