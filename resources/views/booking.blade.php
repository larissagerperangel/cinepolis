@extends('layouts.app')

@section('title', 'Reserva - ' . $movie->title . ' - Cinépolis')

@section('content')
<div class="container py-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4">
        <!-- Información de la película -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="position-relative rounded mb-4" style="height: 350px;">
                        <img src="{{ asset('images/movies/' . $movie->poster_image) }}" class="w-100 h-100 object-fit-cover rounded" alt="{{ $movie->title }}">
                    </div>
                    
                    <h1 class="fs-4 fw-bold mb-2">{{ $movie->title }}</h1>
                    
                    <div class="d-flex align-items-center text-muted mb-2 small">
                        <i class="far fa-clock me-2"></i>
                        <span>{{ $movie->duration }} min</span>
                    </div>
                    
                    <div class="d-flex align-items-center text-muted mb-3 small">
                        <i class="far fa-calendar-alt me-2"></i>
                        <span id="selected-day-time">
                            {{ $days[request()->input('day', 0)] }} - {{ request()->input('time', '') }}
                        </span>
                    </div>
                    
                    <div class="bg-light p-3 rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Prezo por entrada:</span>
                            <span class="fw-bold">7,50 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Número de entradas:</span>
                            <span class="fw-bold" id="selected-seats-count">0</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold border-top border-secondary-subtle pt-2 mt-2">
                            <span>Total:</span>
                            <span id="total-price">0,00 €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulario de Reservas -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white p-0">
                    <ul class="nav nav-tabs card-header-tabs" id="bookingTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="seats-tab" data-bs-toggle="tab" data-bs-target="#seats-tab-pane" type="button" role="tab" aria-selected="true">
                                <i class="fas fa-users me-2"></i> Selección de butacas
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-selected="false">
                                <i class="fas fa-credit-card me-2"></i> Pago
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content" id="bookingTabsContent">
                        <!-- Pestaña de los asientos -->
                        <div class="tab-pane fade show active" id="seats-tab-pane" role="tabpanel" tabindex="0">
                            <h2 class="fs-5 fw-bold mb-3">Selecciona día e hora</h2>
                            
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
                                @foreach($days as $index => $day)
                                <div class="col">
                                    <button type="button" class="day-button btn w-100 {{ request()->input('day', 0) == $index ? 'btn-danger' : 'btn-outline-secondary' }}" data-day="{{ $index }}">
                                        <i class="far fa-calendar-alt me-2"></i> {{ $day }}
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="row row-cols-3 row-cols-sm-4 row-cols-md-5 g-2 mb-4">
                                @foreach($movie->showtimes as $showtime)
                                <div class="col">
                                    <button type="button" class="time-button btn w-100 {{ request()->input('time') == $showtime->time ? 'btn-danger' : 'btn-outline-secondary' }}" data-time="{{ $showtime->time }}">
                                        {{ $showtime->time }}<small class="text-muted"> Sala {{ $showtime->room }}</small>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            
                            <h2 class="fs-5 fw-bold mb-3">Número de entradas</h2>
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <button type="button" id="decrease-seats" class="btn btn-outline-secondary">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="fs-5 fw-bold" id="seats-count">2</span>
                                <button type="button" id="increase-seats" class="btn btn-outline-secondary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <h2 class="fs-5 fw-bold mb-3">Selecciona as túas butacas</h2>
                            
                            <div class="mb-4">
                                <div class="w-100 bg-secondary-subtle text-center py-2 mb-4 rounded">PANTALLA</div>
                                
                                <div class="d-flex flex-column align-items-center gap-2">
                                    @foreach(['A', 'B', 'C', 'D', 'E'] as $row)
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="fw-bold" style="width: 30px;">{{ $row }}</span>
                                        <div class="d-flex gap-2">
                                            @for($i = 0; $i <= 9; $i++)
                                            @php
                                                $seat = $row . $i;
                                                // Algunos asientos ya están ocupados
                                                $isOccupied = 
                                                    ($row === 'B' && $i === 3) ||
                                                    ($row === 'C' && $i === 7) ||
                                                    ($row === 'D' && $i === 2) ||
                                                    ($row === 'A' && $i === 8);
                                            @endphp
                                            <button 
                                                type="button"
                                                class="seat-button btn btn-sm {{ $isOccupied ? 'btn-secondary' : 'btn-outline-secondary' }} rounded-top-1 rounded-bottom-0"
                                                style="width: 32px; height: 32px;"
                                                data-seat="{{ $seat }}"
                                                {{ $isOccupied ? 'disabled' : '' }}
                                            >
                                                {{ $i }}
                                            </button>
                                            @endfor
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-secondary-subtle" style="width: 16px; height: 16px; border-radius: 2px;"></div>
                                        <span class="small">Dispoñible</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-danger" style="width: 16px; height: 16px; border-radius: 2px;"></div>
                                        <span class="small">Seleccionada</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-secondary" style="width: 16px; height: 16px; border-radius: 2px;"></div>
                                        <span class="small">Ocupada</span>
                                    </div>
                                </div>
                                
                                <button 
                                    type="button"
                                    id="continue-to-payment"
                                    class="btn btn-danger"
                                    disabled
                                >
                                    Continuar
                                </button>
                            </div>
                        </div>
                        
                        <!-- Pestaña para realizar el pago -->
                        <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" tabindex="0">
                            <form id="booking-form" action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="showtime_id" id="showtime-id" value="{{ $movie->showtimes->first()->id ?? 1 }}">
                                <input type="hidden" name="seats" id="selected-seats" value="">
                                
                                <h2 class="fs-5 fw-bold mb-3">Información de contacto</h2>
                                
                                <div class="mb-4">
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
                                </div>
                                
                                <h2 class="fs-5 fw-bold mb-3">Método de pago</h2>
                                
                                <div class="mb-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" checked>
                                        <label class="form-check-label" for="card">
                                            <i class="fas fa-credit-card me-2"></i> Tarxeta de crédito/débito
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">
                                            <i class="fab fa-paypal me-2"></i> PayPal
                                        </label>
                                    </div>
                                    
                                    <div id="card-payment-fields">
                                        <div class="mb-3">
                                            <label for="card-number" class="form-label">Número de tarxeta</label>
                                            <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9012 3456" required>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="expiry" class="form-label">Data de caducidade</label>
                                                <input type="text" class="form-control" id="expiry" placeholder="MM/AA" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cvv" class="form-label">CVV</label>
                                                <input type="text" class="form-control" id="cvv" placeholder="123" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="back-to-seats" class="btn btn-outline-secondary">
                                        Volver
                                    </button>
                                    
                                    <button type="submit" class="btn btn-danger">
                                        Completar reserva
                                    </button>
                                </div>
                            </form>
                        </div>
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
    .nav-tabs .nav-link.active {
        color: #D32F2F;
        font-weight: 500;
        border-bottom-color: #D32F2F;
    }
    .nav-tabs .nav-link:hover:not(.active) {
        border-color: transparent;
        color: #D32F2F;
    }
    .seat-button.selected {
        background-color: #D32F2F;
        color: white;
        border-color: #D32F2F;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables
        const dayButtons = document.querySelectorAll('.day-button');
        const timeButtons = document.querySelectorAll('.time-button');
        const seatButtons = document.querySelectorAll('.seat-button:not([disabled])');
        const decreaseSeatsBtn = document.getElementById('decrease-seats');
        const increaseSeatsBtn = document.getElementById('increase-seats');
        const seatsCountEl = document.getElementById('seats-count');
        const selectedDayTimeEl = document.getElementById('selected-day-time');
        const selectedSeatsCountEl = document.getElementById('selected-seats-count');
        const totalPriceEl = document.getElementById('total-price');
        const continueToPaymentBtn = document.getElementById('continue-to-payment');
        const paymentTab = document.getElementById('payment-tab');
        const seatsTab = document.getElementById('seats-tab');
        const seatsContent = document.getElementById('seats-tab-pane');
        const paymentContent = document.getElementById('payment-tab-pane');
        const backToSeatsBtn = document.getElementById('back-to-seats');
        const selectedSeatsInput = document.getElementById('selected-seats');
        const showtimeIdInput = document.getElementById('showtime-id');
        
        // Estado
        let state = {
            day: {{ request()->input('day', 0) }},
            time: "{{ request()->input('time', '') }}",
            maxSeats: 10,
            seatsCount: 2,
            selectedSeats: [],
            seatPrice: 7.50
        };
        
        // Funciones
        function updateUI() {
            // Actualización de los botones del día
            dayButtons.forEach(btn => {
                const day = parseInt(btn.getAttribute('data-day'));
                if (day === state.day) {
                    btn.classList.add('btn-danger');
                    btn.classList.remove('btn-outline-secondary');
                } else {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-outline-secondary');
                }
            });
            
            // Actualización de los botones del tiempo
            timeButtons.forEach(btn => {
                const time = btn.getAttribute('data-time');
                if (time === state.time) {
                    btn.classList.add('btn-danger');
                    btn.classList.remove('btn-outline-secondary');
                } else {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-outline-secondary');
                }
            });
            
            // Actualización del conteo de los asientos
            seatsCountEl.textContent = state.seatsCount;
            
            // Actualización del día y el tiempo seleccionado
            const days = ['Hoxe', 'Mañá', 'Pasado mañá'];
            selectedDayTimeEl.textContent = `${days[state.day]} - ${state.time}`;
            
            // Actualización de los sitios seleccionados
            seatButtons.forEach(btn => {
                const seat = btn.getAttribute('data-seat');
                if (state.selectedSeats.includes(seat)) {
                    btn.classList.add('selected');
                } else {
                    btn.classList.remove('selected');
                }
            });
            
            // Actualizar el número de asientos seleccionados y el precio total
            selectedSeatsCountEl.textContent = state.selectedSeats.length;
            totalPriceEl.textContent = `${(state.selectedSeats.length * state.seatPrice).toFixed(2)} €`;
            
            // Actualización del botón de continuar
            continueToPaymentBtn.disabled = state.selectedSeats.length === 0 || state.time === '';
            
            // Actualizar los botones de los inputs (de los asientos)
            selectedSeatsInput.value = JSON.stringify(state.selectedSeats);
        }
        
        // Event Listeners
        dayButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                state.day = parseInt(this.getAttribute('data-day'));
                updateUI();
            });
        });
        
        timeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                state.time = this.getAttribute('data-time');
                updateUI();
            });
        });
        
        decreaseSeatsBtn.addEventListener('click', function() {
            if (state.seatsCount > 1) {
                state.seatsCount--;
                // Si tenemos más asientos seleccionados que el nuevo recuento, eliminamos los últimos
                if (state.selectedSeats.length > state.seatsCount) {
                    state.selectedSeats = state.selectedSeats.slice(0, state.seatsCount);
                }
                updateUI();
            }
        });
        
        increaseSeatsBtn.addEventListener('click', function() {
            if (state.seatsCount < state.maxSeats) {
                state.seatsCount++;
                updateUI();
            }
        });
        
        seatButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const seat = this.getAttribute('data-seat');
                const index = state.selectedSeats.indexOf(seat);
                
                if (index > -1) {     
                    //El asiento ya está seleccionado, elimínelo
                    state.selectedSeats.splice(index, 1);
                } else if (state.selectedSeats.length < state.seatsCount) {
                    //El asiento no está seleccionado y no hemos alcanzado el límite
                    state.selectedSeats.push(seat);
                }
                
                updateUI();
            });
        });
        
        continueToPaymentBtn.addEventListener('click', function() {
            if (!this.disabled) {
                paymentTab.click();
            }
        });
        
        backToSeatsBtn.addEventListener('click', function() {
            seatsTab.click();
        });
        
        // Alternar método de pago
        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
        const cardPaymentFields = document.getElementById('card-payment-fields');
        
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'card') {
                    cardPaymentFields.classList.remove('d-none');
                } else {
                    cardPaymentFields.classList.add('d-none');
                }
            });
        });
        
        // Inicializar la interfaz de usuario
        updateUI();
    });
</script>
@endpush