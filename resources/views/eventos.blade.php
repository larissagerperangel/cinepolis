@extends('layouts.app')

@section('title', 'Eventos - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <i class="far fa-calendar-alt text-danger me-2"></i>
        <h1 class="fs-2 fw-bold mb-0">Eventos especiais</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <p class="text-muted mb-5 col-lg-8"> <!-- Presento la sección de eventos con un breve resumen explicativo -->
        Descubre os eventos exclusivos que temos preparados para ti no noso cine. Desde maratóns temáticas ata estreas
        con convidados especiais, sempre hai algo novo que experimentar.
    </p>
    
    <!-- Lista de Eventos Activos --> 
    <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
        @foreach($events as $event) <!-- Muestro cada evento en una tarjeta horizontal dividida en dos columnas -->
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="row g-0 h-100">
                    <div class="col-lg-5"> <!-- Imagen de portada del evento -->
                        <img src="{{ asset('images/events/' . $event->image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $event->title }}">
                    </div>
                    <div class="col-lg-7"> <!-- Título del evento -->
                        <div class="card-body d-flex flex-column h-100">
                            <h2 class="card-title fs-4 fw-bold mb-2">{{ $event->title }}</h2>
                            
                            <div class="d-flex flex-wrap gap-3 mb-3">
                                <div class="d-flex align-items-center text-muted small"> <!-- data -->
                                    <i class="far fa-calendar-alt text-danger me-1"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span> <!-- la data era un campo datetime y lo modifico a solo date -->
                                </div>
                                <div class="d-flex align-items-center text-muted small"> <!-- hora -->
                                    <i class="far fa-clock text-danger me-1"></i>
                                    <span>{{ $event->time }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted small"> <!-- sala -->
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    <span>Sala {{ $event->room }}</span>
                                </div>
                            </div>
                            
                            <p class="card-text mb-4">{{ $event->description }}</p> <!-- Descripción -->
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto"> <!-- botón de reserva -->
                                <span class="fw-bold fs-5">{{ $event->price }}</span>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('eventos.show', $event->id) }}" class="btn btn-outline-secondary">Detalles</a>
                                    <a href="{{ route('eventos.booking', $event->id) }}" class="btn btn-danger">Reservar praza</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Sección de eventos próximos -->
    <section class="mb-5">
        <h2 class="fs-3 fw-bold mb-4">Próximamente</h2>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($upcomingEvents as $event)
            <div class="col">
                <div class="card shadow-sm h-100"> <!-- diseño más compacto y vertical (tarjeta de contenido) -->
                    <div class="position-relative">
                        <img src="{{ asset('images/events/' . $event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $event->title }}"> <!-- imagen -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning">Próximamente</span> <!-- insignia de proximamente en dorado -->
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fs-5 fw-bold mb-2">{{ $event->title }}</h3> <!-- título -->
                        <p class="card-text text-muted small mb-3">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p> <!-- data --> 
                        <a href="{{ route('eventos.show', $event->id) }}" class="btn btn-outline-secondary w-100">Máis información</a> <!-- botón de más información --> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <!-- Sección de Subscripción -->
    <section>
        <div class="bg-dark text-white rounded p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fs-3 fw-bold mb-2">Non te perdas ningún evento</h2>
                    <p class="text-light mb-0">
                        Subscríbete á nosa newsletter para recibir información sobre os próximos eventos especiais.
                    </p>
                </div>
                <div class="col-lg-4">
                    <form id="newsletter-form" class="d-flex gap-2">
                        <input type="email" id="newsletter-email" name="email" class="form-control" placeholder="O teu email" required>
                        <button type="submit" class="btn btn-warning">Subscribirse</button>
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

@push('styles')
<style>
    .object-fit-cover { /*  para que las imagenes se recorten bien y mantengan su proporción */
        object-fit: cover;
    }
</style>
@endpush