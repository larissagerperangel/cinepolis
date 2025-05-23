<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($id)// Muestro el formulario de reserva para una película
    {
        $movie = Movie::findOrFail($id);
        $days = ['Hoxe', 'Mañá', 'Pasado mañá'];
        
        // Obtener los horarios disponibles para esta película
        $showtimes = Showtime::where('movie_id', $id)
                            ->orderBy('time')
                            ->get()
                            ->groupBy('date');
        
        return view('booking', compact('movie', 'days', 'showtimes'));
    }
    
    public function store(Request $request)// Proceso el formulario de reserva
    {
        $request->validate([ // Valido los datos del formulario
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array',
            'payment_method' => 'required|in:card,paypal',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        $showtime = Showtime::findOrFail($request->showtime_id);
        $seatPrice = 7.50;
        $totalPrice = count($request->seats) * $seatPrice;
        
        // Verifico que los asientos estén disponibles
        $availableSeats = $showtime->available_seats ?? [];
        foreach ($request->seats as $seat) {
            if (in_array($seat, $availableSeats)) {
                return back()->with('error', 'Algún dos asentos seleccionados xa non está dispoñible.');
            }
        }
        
        // Actualizo los asientos disponibles en la BD
        $showtime->available_seats = array_merge($availableSeats, $request->seats);
        $showtime->save();
        
        // Crear la nueva reserva
        $booking = Booking::create([
            'user_id' => Auth::id() ?? 1, // Si no hay usuario autenticado, usar ID 1
            'showtime_id' => $request->showtime_id,
            'seats' => $request->seats,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
        ]);
        
        return redirect()->route('home')->with('success', 'Reserva completada con éxito.'); // Redirijo al usuario a la página principal con un mensaje de éxito
    }
}