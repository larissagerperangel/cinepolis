/**
 * Cinépolis - JavaScript principal
 */

document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad para el carrusel en la página de inicio
    const Carousel = document.getElementById('Carousel');
    if (Carousel) {
        const carousel = new bootstrap.Carousel(Carousel, {
            interval: 5000, // Cada 5s se mueve el Carusel
            wrap: true
        });
    }
    
    // Funcionalidad para las pestañas
    const tabElements = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabElements.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', function(event) {
            // Podría agregar funcionalidad adicional cuando se muestra una pestaña
        });
    });
    
    // Funcionalidad para el modal de trailer
    const trailerModal = document.getElementById('trailerModal');
    if (trailerModal) {
        trailerModal.addEventListener('hidden.bs.modal', function(event) {
            // Pausar el video cuando se cierra el modal
            const iframes = trailerModal.querySelectorAll('iframe');
            iframes.forEach(iframe => {
                const src = iframe.src;
                iframe.src = src; // Recargar el iframe para detener el video
            });
        });
    }
    
    // Funcionalidad para la página de reservas
    initBookingPage();
    
    // Funcionalidad para mensajes de alerta
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000); // Cerrar alertas después de 5 segundos
    });
});

/**
 * Inicializa la funcionalidad de la página de reservas
 */
function initBookingPage() {
    // Variables para la página de reservas
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
    const backToSeatsBtn = document.getElementById('back-to-seats');
    const selectedSeatsInput = document.getElementById('selected-seats');
    
    // Si no estamos en la página de reservas, salir
    if (!dayButtons.length || !timeButtons.length) return;
    
    // Estado de la reserva
    let state = {
        day: parseInt(new URLSearchParams(window.location.search).get('day') || 0),
        time: new URLSearchParams(window.location.search).get('time') || '',
        maxSeats: 10,
        seatsCount: 2,
        selectedSeats: [],
        seatPrice: 7.50
    };
    
    // Funciones
    function updateUI() {
        // Actualizar botones de día
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
        
        // Actualizar botones de hora
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
        
        // Actualizar contador de asientos
        if (seatsCountEl) seatsCountEl.textContent = state.seatsCount;
        
        // Actualizar día y hora seleccionados
        const days = ['Hoxe', 'Mañá', 'Pasado mañá'];
        if (selectedDayTimeEl) selectedDayTimeEl.textContent = `${days[state.day]} - ${state.time}`;
        
        // Actualizar asientos seleccionados
        seatButtons.forEach(btn => {
            const seat = btn.getAttribute('data-seat');
            if (state.selectedSeats.includes(seat)) {
                btn.classList.add('selected');
            } else {
                btn.classList.remove('selected');
            }
        });
        
        // Actualizar contador de asientos seleccionados y precio total
        if (selectedSeatsCountEl) selectedSeatsCountEl.textContent = state.selectedSeats.length;
        if (totalPriceEl) totalPriceEl.textContent = `${(state.selectedSeats.length * state.seatPrice).toFixed(2)} €`;
        
        // Actualizar botón de continuar
        if (continueToPaymentBtn) {
            continueToPaymentBtn.disabled = state.selectedSeats.length === 0 || state.time === '';
        }
        
        // Actualizar campos ocultos del formulario
        if (selectedSeatsInput) selectedSeatsInput.value = JSON.stringify(state.selectedSeats);
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
    
    if (decreaseSeatsBtn) {
        decreaseSeatsBtn.addEventListener('click', function() {
            if (state.seatsCount > 1) {
                state.seatsCount--;
                // Si tenemos más asientos seleccionados que el nuevo límite, eliminar los últimos
                if (state.selectedSeats.length > state.seatsCount) {
                    state.selectedSeats = state.selectedSeats.slice(0, state.seatsCount);
                }
                updateUI();
            }
        });
    }
    
    if (increaseSeatsBtn) {
        increaseSeatsBtn.addEventListener('click', function() {
            if (state.seatsCount < state.maxSeats) {
                state.seatsCount++;
                updateUI();
            }
        });
    }
    
    seatButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const seat = this.getAttribute('data-seat');
            const index = state.selectedSeats.indexOf(seat);
            
            if (index > -1) {
                // El asiento ya está seleccionado, quitarlo
                state.selectedSeats.splice(index, 1);
            } else if (state.selectedSeats.length < state.seatsCount) {
                // El asiento no está seleccionado y no hemos alcanzado el límite
                state.selectedSeats.push(seat);
            }
            
            updateUI();
        });
    });
    
    if (continueToPaymentBtn) {
        continueToPaymentBtn.addEventListener('click', function() {
            if (!this.disabled && paymentTab) {
                paymentTab.click();
            }
        });
    }
    
    if (backToSeatsBtn) {
        backToSeatsBtn.addEventListener('click', function() {
            if (document.getElementById('seats-tab')) {
                document.getElementById('seats-tab').click();
            }
        });
    }
    
    // Inicializar UI (interfaz de usuario)
    updateUI();
}