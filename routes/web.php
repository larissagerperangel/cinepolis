<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cartelera', [MovieController::class, 'index'])->name('cartelera');
// Cuando un usuario visita "/cartelera" con el método GET, ejecuta el método "index()" del "MovieController", a esta ruta se le puede referenciar como "route('cartelera')" dentro del código
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/eventos', [EventController::class, 'index'])->name('eventos');
Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'send'])->name('contacto.send');

// Rutas para reservas
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Rutas de autenticación (ya incluidas en Laravel)
Auth::routes();