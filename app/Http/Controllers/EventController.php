<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index() // Muestro todos las eventos proximos y los ordeno por fecha
    {
        $events = Event::orderBy('date', 'asc')->get();
        $upcomingEvents = Event::where('date', '>', now())
                              ->orderBy('date', 'asc')
                              ->take(4)
                              ->get();
        
        return view('eventos', compact('events', 'upcomingEvents')); // le devuelvo un array con los eventos y lo relacionado a ellos, a las vistas
    }
    
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event-details', compact('event'));
    }
    
    public function createBooking($id)
    {
        $event = Event::findOrFail($id);
        return view('event-booking', compact('event'));
    }
    
    public function storeBooking(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'tickets' => 'required|integer|min:1|max:10',
        ]);
        
        $event = Event::findOrFail($request->event_id);
        
        // Guardar la reserva en logs
        Log::info('Nueva reserva de evento', [
            'event_id' => $request->event_id,
            'event_title' => $event->title,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'tickets' => $request->tickets,
            'timestamp' => now()
        ]);
        
        return redirect()->route('eventos')->with('success', 'Reserva de evento completada con éxito.');
    }
}