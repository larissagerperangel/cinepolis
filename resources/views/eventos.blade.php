@extends('layouts.app')

@section('title', 'Eventos - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <i class="far fa-calendar-alt text-danger me-2"></i>
        <h1 class="fs-2 fw-bold mb-0">Eventos especiais</h1>
    </div>
    
    <p class="text-muted mb-5 col-lg-8">
        Descubre os eventos exclusivos que temos preparados para ti no noso cine. Desde maratóns temáticas ata estreas
        con convidados especiais, sempre hai algo novo que experimentar.
    </p>
    
    <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
        @foreach($events as $event)
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="row g-0 h-100">
                    <div class="col-lg-5">
                        <img src="{{ asset('images/events/' . $event->image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $event->title }}">
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body d-flex flex-column h-100">
                            <h2 class="card-title fs-4 fw-bold mb-2">{{ $event->title }}</h2>
                            
                            <div class="d-flex flex-wrap gap-3 mb-3">
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="far fa-calendar-alt text-danger me-1"></i>
                                    <span>{{ $event->date }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="far fa-clock text-danger me-1"></i>
                                    <span>{{ $event->time }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    <span>Sala {{ $event->room }}</span>
                                </div>
                            </div>
                            
                            <p class="card-text mb-4">{{ $event->description }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-bold fs-5">{{ $event->price }}</span>
                                <a href="#" class="btn btn-danger">Reservar praza</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Upcoming Events Section -->
    <section class="mb-5">
        <h2 class="fs-3 fw-bold mb-4">Próximamente</h2>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($upcomingEvents as $event)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/events/' . $event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $event->title }}">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-warning">Próximamente</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title fs-5 fw-bold mb-2">{{ $event->title }}</h3>
                        <p class="card-text text-muted small mb-3">{{ $event->date }}</p>
                        <a href="#" class="btn btn-outline-secondary w-100">Máis información</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <!-- Newsletter Section -->
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
                    <form action="#" method="POST" class="d-flex gap-2">
                        <input type="email" class="form-control" placeholder="O teu email" required>
                        <button type="submit" class="btn btn-warning">Subscribirse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush