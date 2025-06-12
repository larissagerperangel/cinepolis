<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($id) // Muestro el formulario de reserva para una película
    {
        // Cargar la película con sus horarios
        $movie = Movie::with('showtimes')->findOrFail($id);
        $days = ['Hoxe', 'Mañá', 'Pasado mañá'];
        
        return view('booking', compact('movie', 'days'));
    }
    
    public function store(Request $request) // Proceso el formulario de reserva
    {
        $request->validate([ // Valido los datos del formulario
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|string', // Cambiado a string porque viene como JSON
            'payment_method' => 'required|in:card,paypal',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        // Decodificar los asientos del JSON
        $seats = json_decode($request->seats, true);
        
        if (!is_array($seats) || empty($seats)) {
            return back()->with('error', 'Debes seleccionar polo menos un asento.');
        }
        
        $showtime = Showtime::findOrFail($request->showtime_id);
        $seatPrice = 7.50;
        $totalPrice = count($seats) * $seatPrice;
        
        // Verificar que los asientos estén disponibles
        $occupiedSeats = $showtime->available_seats;
        
        // Asegurar que $occupiedSeats es un array
        if (!is_array($occupiedSeats)) {
            $occupiedSeats = [];
        }
        
        foreach ($seats as $seat) {
            if (in_array($seat, $occupiedSeats)) {
                return back()->with('error', 'Algún dos asentos seleccionados xa non está dispoñible.');
            }
        }
        
        // Actualizar los asientos ocupados
        $newOccupiedSeats = array_merge($occupiedSeats, $seats);
        $showtime->update(['available_seats' => $newOccupiedSeats]);
        
        // Crear la reserva
        $booking = Booking::create([
            'user_id' => Auth::id() ?? null, // Si no hay usuario autenticado, usar null
            'showtime_id' => $request->showtime_id,
            'seats' => $seats,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'customer_name' => $request->name,
            'customer_email' => $request->email,
        ]);
        
        return redirect()->route('home')->with('success', 'Reserva completada con éxito. Recibirás un email de confirmación.'); // Redirijo al usuario a la página principal con un mensaje de éxito
    }
}