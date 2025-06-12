<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function index()// Muestro todas las películas y géneros en la página de cartelera
    {
        $movies = Movie::with('showtimes')->get();
        $genres = Movie::select('genre')->distinct()->pluck('genre');
        
        return view('cartelera', compact('movies', 'genres'));
    }
    
    public function show($id) // Muestro los detalles de una película específica
    {
        $movie = Movie::with('showtimes')->findOrFail($id); // Busco la película por ID o devuelvo un error 404 si no existe
        $relatedMovies = Movie::where('genre', $movie->genre)
                              ->where('id', '!=', $id)
                              ->take(4)
                              ->get(); // busco películas relacionadas del mismo género
        
        return view('movies.show', compact('movie', 'relatedMovies')); // le devuelvo un array con la pelicula y lo relacionado a ella, a las vistas
    }
}