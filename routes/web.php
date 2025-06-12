<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ReservaController;

// Rutas públicas 
Route::get('/peliculas', [MovieController::class, 'index'])->name('movies.index');
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

// Rutas para eventos (USANDO EventController)
Route::get('/eventos/{id}', [EventController::class, 'show'])->name('eventos.show');
Route::get('/eventos/{id}/reservar', [EventController::class, 'createBooking'])->name('eventos.booking');
Route::post('/eventos/reservas', [EventController::class, 'storeBooking'])->name('eventos.booking.store');

// Rutas de autenticación 
Auth::routes(['verify' => true]); // Opcional: para verificación de email

// Ruta después de login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas API internas para el JavaScript moderno
Route::prefix('api')->group(function () {
    Route::get('/movies', [SpaController::class, 'getMovies']);
    Route::get('/movies/{id}', [SpaController::class, 'getMovie']);
    Route::get('/events', [SpaController::class, 'getEvents']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas relacionadas al incio de sesesión
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas');
});