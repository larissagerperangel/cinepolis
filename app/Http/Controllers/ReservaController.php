<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Auth::user()->bookings()
                        ->with('showtime.movie')
                        ->latest()
                        ->get();

        return view('reservas.index', compact('reservas'));
    }
}