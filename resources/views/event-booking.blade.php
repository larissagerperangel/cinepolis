@extends('layouts.app')

@section('title', 'Reservar - ' . $event->title . ' - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Información del evento -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="position-relative rounded mb-4" style="height: 250px;">
                        <img src="{{ asset('images/events/' . $event->image) }}" class="w-100 h-100 object-fit-cover rounded" alt="{{ $event->title }}">
                    </div>
                    
                    <h1 class="fs-4 fw-bold mb-2">{{ $event->title }}</h1>
                    
                    <div class="d-flex align-items-center text-muted mb-2 small">
                        <i class="far fa-calendar-alt me-2"></i>
                        <span>{{ $event->date }}</span>
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
                        <div class="d-flex justify-content-between mb-2">
                            <span>Prezo por entrada:</span>
                            <span class="fw-bold">{{ $event->price }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Número de entradas:</span>
                            <span class="fw-bold" id="tickets-count">1</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold border-top border-secondary-subtle pt-2 mt-2">
                            <span>Total:</span>
                            <span id="total-price">{{ $event->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulario de reserva -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="fs-4 fw-bold mb-4">Reservar entradas</h2>
                    
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('eventos.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        
                        <div class="mb-4">
                            <label for="tickets" class="form-label">Número de entradas</label>
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" id="decrease-tickets" class="btn btn-outline-secondary">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center" id="tickets" name="tickets" value="1" min="1" max="10" style="width: 80px;" readonly>
                                <button type="button" id="increase-tickets" class="btn btn-outline-secondary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <h3 class="fs-5 fw-bold mb-3">Información de contacto</h3>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="phone" class="form-label">Teléfono (opcional)</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('eventos.show', $event->id) }}" class="btn btn-outline-secondary">Volver</a>
                            <button type="submit" class="btn btn-danger">Completar reserva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.getElementById('decrease-tickets');
        const increaseBtn = document.getElementById('increase-tickets');
        const ticketsInput = document.getElementById('tickets');
        const ticketsCountEl = document.getElementById('tickets-count');
        const totalPriceEl = document.getElementById('total-price');
        
        // Precio base del evento (extraer número del precio)
        const basePrice = parseFloat('{{ $event->price }}'.replace(/[^\d.,]/g, '').replace(',', '.'));
        
        function updatePrice() {
            const tickets = parseInt(ticketsInput.value);
            const total = (tickets * basePrice).toFixed(2);
            
            ticketsCountEl.textContent = tickets;
            totalPriceEl.textContent = total + ' €';
        }
        
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(ticketsInput.value);
            if (currentValue > 1) {
                ticketsInput.value = currentValue - 1;
                updatePrice();
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(ticketsInput.value);
            if (currentValue < 10) {
                ticketsInput.value = currentValue + 1;
                updatePrice();
            }
        });
        
        // Inicializar precio
        updatePrice();
    });
</script>
@endpush

@push('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush
