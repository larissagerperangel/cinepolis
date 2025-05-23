<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()// Este método se ejecuta cuando un usuario visita la página principal
    {
        // Obtener las 3 películas más recientes para el carrusel principal
        $featuredMovies = Movie::orderBy('release_date', 'desc')->take(3)->get();
        
        // Obtener 4 películas para la sección de cartelera
        $otherMovies = Movie::orderBy('release_date', 'desc')->skip(3)->take(4)->get();
        
        // Obtener 2 eventos próximos
        $events = Event::orderBy('date', 'asc')->take(2)->get();
        
        return view('home', compact('featuredMovies', 'otherMovies', 'events')); // crea un array con las variables para pasarlas a la vista
    }
}