<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Event;

class SpaController extends Controller
{
    /**
     * Obtener datos para la API interna
     */
    public function getMovies()
    {
        $movies = Movie::with('showtimes')->get();
        return response()->json($movies);
    }
    
    public function getMovie($id)
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
    
    public function getEvents()
    {
        $events = Event::orderBy('date', 'asc')->get();
        return response()->json($events);
    }
}