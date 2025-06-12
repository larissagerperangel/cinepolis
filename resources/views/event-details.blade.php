@extends('layouts.app')

@section('title', $event->title . ' - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Información del evento -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="position-relative rounded mb-4" style="height: 350px;">
                    <img src="{{ asset('images/events/' . $event->image) }}" class="w-100 h-100 object-fit-cover rounded" alt="{{ $event->title }}">
                </div>
                
                <div class="card-body">
                    <h1 class="fs-4 fw-bold mb-3">{{ $event->title }}</h1>
                    
                    <div class="d-flex align-items-center text-muted mb-2 small">
                        <i class="far fa-calendar-alt me-2"></i>
                        <span>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="d-flex align-items-center text-muted mb-2 small">
                        <i class="far fa-clock me-2"></i>
                        <span>{{ $event->time }}</span>
                    </div>
                    
                    <div class="d-flex align-items-center text-muted mb-3 small">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>Sala {{ $event->room }}</span>
                    </div>
                    
                    <div class="bg-light p-3 rounded">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Prezo:</span>
                            <span class="text-danger">{{ $event->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Detalles del evento -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="fs-3 fw-bold mb-4">Detalles do evento</h2>
                    
                    <p class="mb-4">{{ $event->description }}</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3 class="fs-5 fw-bold mb-2">Data e hora</h3>
                            <p>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }} ás {{ $event->time }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="fs-5 fw-bold mb-2">Localización</h3>
                            <p>Sala {{ $event->room }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('eventos.booking', $event->id) }}" class="btn btn-danger">Reservar praza</a>
                        <a href="{{ route('eventos') }}" class="btn btn-outline-secondary">Volver aos eventos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush
