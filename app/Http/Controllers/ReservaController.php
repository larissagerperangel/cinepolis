<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Auth::user()->bookings() // obtiene el usuario autenticado y accede a la relación definida en el modelo booking
                        ->with('showtime.movie') // Carga la relación showtime y luego la película
                        ->latest() // ordena las reservas por la más reciente
                        ->get(); // ejecuta la consulta y devuelve la colección de reservas

        return view('reservas.index', compact('reservas')); // pasa la variable $reservas a la vista y retorna dicha vista
    }
}