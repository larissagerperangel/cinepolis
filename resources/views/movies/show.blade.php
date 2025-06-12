@extends('layouts.app')

@section('title', $movie->title . ' - Cinépolis')

@section('content')

<div class="position-relative" style="height: 500px;">
    <img src="{{ asset('images/movies/' . $movie->cover_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $movie->title }}">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-dark"></div>
    
    <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="position-relative rounded shadow" style="height: 300px;">
                        <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="w-100 h-100 object-fit-cover rounded" alt="{{ $movie->title }}">
                    </div>
                </div>
                <div class="col-md-9">
                    <h1 class="text-white display-6 fw-bold mb-2">{{ $movie->title }}</h1>
                    
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge border border-white text-white">{{ $movie->genre }}</span>
                        <span class="badge border border-white text-white">{{ $movie->language }}</span>
                        <span class="badge border border-white text-white">{{ $movie->classification }}</span>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-4 mb-3 text-white">
                        <div class="d-flex align-items-center">
                            <i class="far fa-clock me-2"></i>
                            <span>{{ $movie->duration }} min</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>{{ $movie->release_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-star text-warning me-2"></i>
                            <span>{{ $movie->rating }}/10</span>
                        </div>
                    </div>
                    
                    <p class="text-white-50 mb-4 col-lg-10">{{ $movie->short_description }}</p>
                    
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('booking.create', $movie->id) }}" class="btn btn-danger">Comprar entradas</a>
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#trailerModal">
                            <i class="fas fa-play me-2"></i> Ver trailer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Pestaña de detalle de las películas -->
    <ul class="nav nav-tabs mb-4" id="movieTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="synopsis-tab" data-bs-toggle="tab" data-bs-target="#synopsis-tab-pane" type="button" role="tab" aria-selected="true">Sinopse</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="showtimes-tab" data-bs-toggle="tab" data-bs-target="#showtimes-tab-pane" type="button" role="tab" aria-selected="false">Horarios</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cast-tab" data-bs-toggle="tab" data-bs-target="#cast-tab-pane" type="button" role="tab" aria-selected="false">Reparto</button>
        </li>
    </ul>
    
    <div class="tab-content mb-5" id="movieTabsContent">
        <!-- Pestaña de la sinopsis-->
        <div class="tab-pane fade show active" id="synopsis-tab-pane" role="tabpanel" tabindex="0">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fs-4 fw-bold mb-3">Sinopse</h2>
                    <p class="mb-4">{{ $movie->description }}</p>
                    
                    <h3 class="fs-5 fw-bold mb-2">Director</h3>
                    <p class="mb-4">{{ $movie->director }}</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="fs-5 fw-bold mb-2">Xénero</h3>
                            <p>{{ $movie->genre }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="fs-5 fw-bold mb-2">Idioma</h3>
                            <p>{{ $movie->language }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pestaña de los horarios -->
        <div class="tab-pane fade" id="showtimes-tab-pane" role="tabpanel" tabindex="0">
            <h2 class="fs-4 fw-bold mb-4">Horarios dispoñibles</h2>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach(['Hoxe', 'Mañá', 'Pasado mañá'] as $day => $dayName)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="card-title fs-5 fw-bold mb-3">
                                <i class="far fa-calendar-alt text-danger me-2"></i>
                                {{ $dayName }}
                            </h3>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($movie->showtimes as $showtime)
                                <a href="{{ route('booking.create', ['id' => $movie->id, 'time' => $showtime->time, 'day' => $day]) }}" class="btn btn-outline-secondary btn-sm">
                                    {{ $showtime->time }} <span class="badge bg-light text-dark border"><small class="text-muted"> Sala {{ $showtime->room }}</small></span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Pestaña de los actores -->
        <div class="tab-pane fade" id="cast-tab-pane" role="tabpanel" tabindex="0">
            <h2 class="fs-4 fw-bold mb-4">Reparto principal</h2>
            
            @if(count($movie->cast) > 0)
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
                @foreach($movie->cast as $index => $actor)
                <div class="col text-center">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto mb-3 actor-image-container" style="width: 120px; height: 120px;">
                        {{-- USAR EL MÉTODO getActorImage() DEL MODELO --}}
                        <img 
                            src="{{ $movie->getActorImage($actor, $index) }}" 
                            class="w-100 h-100 object-fit-cover actor-image" 
                            alt="{{ $actor }}"
                            onerror="this.src='{{ asset('images/cast/default-actor.jpg') }}'"
                            loading="lazy"
                        >
                    </div>
                    <h3 class="fs-6 fw-medium">{{ $actor }}</h3>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    
    <!-- Películas relacionadas -->
    <section>
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-film text-danger me-2"></i>
            <h2 class="fs-4 fw-bold mb-0">Películas similares</h2>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($relatedMovies as $relatedMovie)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative" style="height: 250px;">
                        <img src="{{ asset('images/movies/' . $relatedMovie->poster_image) }}" class="card-img-top h-100 object-fit-cover" alt="{{ $relatedMovie->title }}">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-dark">{{ $relatedMovie->classification }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $relatedMovie->title }}</h5>
                        <div class="d-flex align-items-center text-muted mb-3 small">
                            <i class="fas fa-star text-warning me-1"></i>
                            <span>{{ $relatedMovie->rating }}/10</span>
                        </div>
                        <a href="{{ route('movies.show', $relatedMovie->id) }}" class="btn btn-danger w-100">Ver detalles</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<!-- Sección Trailer -->
<div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trailerModalLabel">Trailer: {{ $movie->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.3) 100%);
    }
    .object-fit-cover {
        object-fit: cover;
    }
    .nav-tabs .nav-link.active {
        color: #D32F2F;
        font-weight: 500;
        border-bottom-color: #D32F2F;
    }
    .nav-tabs .nav-link:hover:not(.active) {
        border-color: transparent;
        color: #D32F2F;
    }
    .actor-image-container {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 3px solid transparent;
        background: #f8f9fa;
    }
    
    .actor-image-container:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        border-color: #D32F2F;
    }
    
    .actor-image {
        transition: transform 0.3s ease;
    }
    
    .actor-image-container:hover .actor-image {
        transform: scale(1.1);
    }
    
    /* Placeholder para imágenes que no cargan */
    .actor-image-container::before {
        content: '👤';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: #6c757d;
        z-index: 1;
    }
    
    .actor-image {
        position: relative;
        z-index: 2;
    }
</style>
@endpush