@extends('layouts.app')

@section('title', 'As miñas reservas')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">As miñas reservas</h1>
        <a href="{{ url('/') }}" class="btn btn-outline-danger">
            <i class="fas fa-plus me-2"></i>Nova reserva
        </a> <!-- Muestra el título y un botón para volver a la cartelera -->
    </div>

    @if($reservas->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-ticket-alt fa-4x text-muted mb-4"></i>
                <h3 class="h4">Non tes reservas aínda</h3>
                <p class="text-muted mb-4">Cando fagas unha reserva, aparecerá aquí</p>
                <a href="{{ url('/') }}" class="btn btn-danger">
                    Ver carteleira
                </a> <!-- Si el usuario no tiene reservas, se muestra una tarjeta vacía con mensaje informativo y botón para ir a la cartelera -->
            </div>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($reservas as $reserva)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-danger text-white d-flex justify-content-between">
                            <span>Reserva #{{ $reserva->id }}</span>
                            <span class="badge bg-light text-dark">
                                {{ $reserva->created_at->format('d/m/Y') }}
                            </span> <!-- sí tiene reservas -->
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="{{ asset('images/movies/' . $reserva->showtime->movie->poster_image) }}" 
                                     class="img-fluid rounded me-3" 
                                     style="width: 80px; height: 120px; object-fit: cover;" 
                                     alt="{{ $reserva->showtime->movie->title }}">
                                <div>
                                    <h5 class="card-title mb-1">{{ $reserva->showtime->movie->title }}</h5>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-film me-1"></i> 
                                        {{ $reserva->showtime->movie->duration }} min
                                    </p>
                                    <p class="mb-1">
                                        <i class="fas fa-calendar-day me-1"></i>
                                        {{ $reserva->showtime->day }} ás {{ $reserva->showtime->time }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-video me-1"></i>
                                        Sala {{ $reserva->showtime->room }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="fw-bold mb-2">Butacas:</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($reserva->seats as $asiento)
                                        <span class="badge bg-secondary">{{ $asiento }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">Total:</span>
                                    <span class="ms-2">{{ number_format($reserva->total_price, 2) }} €</span>
                                </div>
                                <span class="badge bg-{{ $reserva->status === 'confirmed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($reserva->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection