<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()// Muestro todos las eventos proximos y los ordeno por fecha
    {
        $events = Event::orderBy('date', 'asc')->get();
        $upcomingEvents = Event::where('date', '>', now())
                              ->orderBy('date', 'asc')
                              ->take(4)
                              ->get();
        
        return view('eventos', compact('events', 'upcomingEvents')); // le devuelvo un array con los eventos y lo relacionado a ellos, a las vistas
    }
}