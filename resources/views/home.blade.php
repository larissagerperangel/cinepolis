@extends('layouts.app') <!-- La vista extiende de la plantilla principal -->

@section('title', 'Cinépolis - O teu cine máis cerca') <!-- Definimos el título -->

@section(section: 'content') <!-- Contenido del Inicio -->
<!-- Carusel -->
<div id="Carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($featuredMovies as $index => $movie) <!-- Bucle que itera sobre las 3 películas destacadas -->
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"> <!-- añado "active" al 1º elemento -->
            <div class="position-relative" style="height: 500px;">
                <img src="{{ asset('images/movies/' . $movie->cover_image) }}" class="d-block w-100 h-100 object-fit-cover" alt="{{ $movie->title }}"> <!-- muestro la imagen del cover -->
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-dark"></div>
                <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5">
                    <div class="container">
                        <h2 class="text-white display-6 fw-bold mb-2">{{ $movie->title }}</h2> <!-- el título -->
                        <p class="text-white mb-4 col-md-8">{{ $movie->short_description }}</p> <!-- una breve descripción -->
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-danger btn-fix" style="display: block; width: 15%; text-align: center;">Ver detalles</a> <!-- un botón para ver los detalles de las películas -->
                            <a href="{{ route('booking.create', $movie->id) }}" class="btn btn-outline-light">Comprar entradas</a> <!-- un botón para comprar las entradas -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Para moverse por el Carusel unas flechitas de Anterior "<" y Siguiente ">" -->
    <button class="carousel-control-prev" type="button" data-bs-target="#Carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#Carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<div class="container py-5">
    <!-- Apartado de Cartelera de Películas -->
    <section class="mb-5">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-film text-danger me-2"></i>
            <h2 class="fs-3 fw-bold mb-0">Cartelera actual</h2>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($otherMovies as $movie) <!-- Muestro las películas en cartelera en una grilla de trajetas -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative" style="height: 350px;">
                        <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="card-img-top h-100 object-fit-cover" alt="{{ $movie->title }}"> <!-- Muestro la imagen del poster -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-dark">{{ $movie->classification }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $movie->title }}</h5> <!-- El título de la película -->
                        <div class="d-flex align-items-center text-muted mb-2 small">
                            <i class="far fa-clock me-1"></i>
                            <span>{{ $movie->duration }} min</span> <!-- La duración en minutos -->
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3 small">
                            <i class="fas fa-star text-warning me-1"></i>
                            <span>{{ $movie->rating }}/10</span> <!-- La puntuación sobre 10 -->
                        </div>
                        <a href="{{ route('booking.create', $movie->id) }}" class="btn btn-danger w-100">Comprar entradas</a> <!-- Botón con redirección al formulario de reservar entradas -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('cartelera') }}" class="btn btn-outline-danger">Ver toda a cartelera</a>
        </div> <!-- Botón con redirección a la sección de la cartelera completa -->
    </section>
    
    <!-- Apartado de Proximos Eventos -->
    <section class="mb-5">
        <div class="d-flex align-items-center mb-4">
            <i class="far fa-calendar-alt text-danger me-2"></i>
            <h2 class="fs-3 fw-bold mb-0">Próximos eventos</h2>
        </div>
        
        <div class="row g-4">
            @foreach($events as $event) <!-- Muestro eventos como estrenos -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-4">
                            <img src="{{ asset('images/events/' . $event->image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $event->title }}"> <!-- Imagen del evento -->
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $event->title }}</h5> <!-- Título del evento -->
                                <p class="card-text text-muted mb-3">{{ $event->date }} - {{ $event->time }}</p> <!-- Data y hora del evento -->
                                <p class="card-text mb-3">{{ $event->description }}</p> <!-- Descripción del evento -->
                                <a href="{{ route('eventos') }}" class="btn btn-danger">Reservar praza</a> <!-- Botón para reservar plaza en el evento -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <!-- Apartado de Hoja de información -->
    <section>
        <div class="bg-dark text-white rounded p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fs-3 fw-bold mb-2">Subscríbete á nosa newsletter</h2>
                    <p class="text-light mb-0">
                        Recibe as últimas novidades, promocións e eventos especiais directamente no teu correo.
                    </p>
                </div>
                <div class="col-lg-4">
                    <form id="newsletter-form" class="d-flex gap-2">
                        <input type="email" id="newsletter-email-home" name="email" class="form-control" placeholder="O teu email" required> <!-- campo email -->
                        <button type="submit" class="btn btn-warning">Subscribirse</button> <!-- botón de subscripción -->
                    </form>

                    <div id="newsletter-success" class="alert alert-success mt-3 d-none" role="alert">
                        Subscrición realizada con éxito!
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('newsletter-form');
        const successMessage = document.getElementById('newsletter-success');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // evita recargar la página
            successMessage.classList.remove('d-none'); // muestra el mensaje
            form.reset(); // limpia el formulario

            // Ocultar el mensaje luego de 4 segundos (opcional)
            setTimeout(() => {
                successMessage.classList.add('d-none');
            }, 4000);
        });
    });
</script>
@endpush

@push('styles') <!-- Llamo al método que me permite añadir CSS -->
<style>
    .bg-gradient-dark {
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
    } /* oscurezco las fotos del carusel para resaltar el texto */
    .object-fit-cover {
        object-fit: cover;
    } /* Aseguro que las imagenes cubrar su espacio asignado sin deformarse */
    .btn-fix {
        position: relative !important;
        z-index: 2 !important;
        display: inline-block !important;
        text-align: center !important;
        cursor: pointer !important;
    }
    .btn-fix:before {/* Crear un área clickeable invisible que cubra todo el botón */
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        z-index: -1 !important;
    }
    .btn-fix * {/* Asegurar que el contenido del botón no interfiera */
        pointer-events: none !important;
    }
</style>
@endpush