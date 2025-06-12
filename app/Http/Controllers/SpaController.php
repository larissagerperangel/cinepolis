<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Event;

class SpaController extends Controller
{
    /**
     * Obtener datos para la API interna (Single Page Application)
     */
    public function getMovies() // Obtener todas las películas
    {
        $movies = Movie::with('showtimes')->get();
        return response()->json($movies);
    }
    
    public function getMovie($id)// Obtener detalle de una película
    {
        $movie = Movie::with(['showtimes', 'bookings'])->findOrFail($id);
        $relatedMovies = Movie::where('genre', $movie->genre)
                              ->where('id', '!=', $id)
                              ->take(4)
                              ->get();
        
        return response()->json([
            'movie' => $movie,
            'related_movies' => $relatedMovies
        ]);
    }
    
    public function getEvents() // Obtener eventos
    {
        $events = Event::orderBy('date', 'asc')->get();
        return response()->json($events);
    }
}