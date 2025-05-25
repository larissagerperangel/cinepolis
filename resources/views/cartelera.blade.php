@extends('layouts.app')

@section('title', 'Cartelera - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-film text-danger me-2"></i>
        <h1 class="fs-2 fw-bold mb-0">Cartelera</h1>
    </div>
    
    <!-- Pestañas de Géneros -->
    <ul class="nav nav-tabs mb-4" id="genreTabs" role="tablist">
        <li class="nav-item" role="presentation"> <!-- Se generan dinámicamente según los géneros disponibles -->
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-selected="true">Todas</button> 
        </li>
        @foreach($genres as $genre)
        <li class="nav-item" role="presentation"> <!-- Cada pestaña activa una "vista" filtrada por género -->
            <button class="nav-link" id="{{ Str::slug($genre) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($genre) }}-tab-pane" type="button" role="tab" aria-selected="false">{{ $genre }}</button>
        </li>
        @endforeach
    </ul>
    
    <!-- Contenido de las Pestañas -->
    <div class="tab-content" id="genreTabsContent">
        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" tabindex="0">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($movies as $movie) <!-- 1ª pestaña, todas las películas -->
                <div class="col">
                    <div class="card h-100 shadow-sm"> 
                        <div class="position-relative" style="height: 350px;">
                            <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="card-img-top h-100 object-fit-cover" alt="{{ $movie->title }}"> <!-- imagen --> 
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-dark">{{ $movie->classification }}</span> <!-- PEGI -->
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $movie->title }}</h5> <!-- título -->
                            <div class="d-flex align-items-center text-muted mb-2 small">
                                <i class="far fa-clock me-1"></i>
                                <span>{{ $movie->duration }} min</span> <!-- duración en min -->
                            </div>
                            <div class="d-flex align-items-center text-muted mb-2 small">
                                <i class="fas fa-star text-warning me-1"></i>
                                <span>{{ $movie->rating }}/10</span> <!-- puntuación sobre 10 -->
                            </div>
                            <p class="card-text small text-muted mb-3">{{ Str::limit($movie->short_description, 100) }}</p> <!-- descripción corta -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('booking.create', $movie->id) }}" class="btn btn-danger flex-grow-1">Comprar</a> <!-- botón comprar -->
                                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-secondary flex-grow-1">Detalles</a> <!-- botón de más detalles -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        @foreach($genres as $genre) <!-- reste de las pesteñas, género a género -->
        <div class="tab-pane fade" id="{{ Str::slug($genre) }}-tab-pane" role="tabpanel" tabindex="0">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($movies->where('genre', $genre) as $movie) <!-- filtro las películas por su género -->
                <div class="col">
                    <div class="card h-100 shadow-sm"> <!-- mismo diseño de tarjeta -->
                        <div class="position-relative" style="height: 350px;">
                            <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="card-img-top h-100 object-fit-cover" alt="{{ $movie->title }}"> <!-- imagen -->
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-dark">{{ $movie->classification }}</span> <!-- PEGI -->
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $movie->title }}</h5> <!-- título -->
                            <div class="d-flex align-items-center text-muted mb-2 small">
                                <i class="far fa-clock me-1"></i>
                                <span>{{ $movie->duration }} min</span> <!-- duración en min -->
                            </div>
                            <div class="d-flex align-items-center text-muted mb-2 small">
                                <i class="fas fa-star text-warning me-1"></i>
                                <span>{{ $movie->rating }}/10</span> <!-- puntuación sobre 10 -->
                            </div>
                            <p class="card-text small text-muted mb-3">{{ Str::limit($movie->short_description, 100) }}</p> <!-- pequeña descripción -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('booking.create', $movie->id) }}" class="btn btn-danger flex-grow-1">Comprar</a> <!-- botón comprar -->
                                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-outline-secondary flex-grow-1">Detalles</a> <!-- botón de más detalles -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Sección de horarios de hoy -->
    <section class="mt-5 p-4 bg-light rounded">
        <div class="d-flex align-items-center mb-3">
            <i class="far fa-calendar-alt text-danger me-2"></i>
            <h2 class="fs-4 fw-bold mb-0">Horarios de hoxe</h2>
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($movies->take(6) as $movie) <!-- 6 cajitas -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex gap-3">
                            <div style="width: 60px; height: 90px;" class="flex-shrink-0">
                                <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="img-fluid rounded h-100 w-100 object-fit-cover" alt="{{ $movie->title }}"> <!-- imagen -->
                            </div>
                            <div>
                                <h6 class="card-title fw-bold mb-2">{{ $movie->title }}</h6> <!-- título -->
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    @foreach($movie->showtimes as $showtime) <!-- horarios -->
                                    <span class="badge bg-light text-dark border">{{ $showtime->time }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ route('booking.create', $movie->id) }}" class="text-danger small fw-medium text-decoration-none">Reservar</a> <!-- botón de reservas -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
    .nav-tabs .nav-link.active { /* Colorea la pestaña activa en rojo */
        color: #D32F2F;
        font-weight: 500;
        border-bottom-color: #D32F2F;
    }
    .nav-tabs .nav-link:hover:not(.active) {
        border-color: transparent;
        color: #D32F2F;
    }
</style>
@endpush