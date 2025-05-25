@extends('layouts.app')

@section('title', 'Contacto - Cinépolis')

@section('content')
<div class="container py-5">
    <h1 class="fs-2 fw-bold mb-4">Contacto</h1>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }} <!-- Muestro una alerta si el formulario se envió correctamente -->
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="row g-4 mb-5">
        <!-- Información de Contacto -->
        <div class="col-lg-6"> <!-- columna a la izquierda -->
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="fs-4 fw-bold mb-4">Información de contacto</h2>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-map-marker-alt text-danger fs-4"></i>
                        </div>
                        <div>
                            <h3 class="fs-5 fw-bold mb-2">Dirección</h3>
                            <p class="text-muted mb-0">Rúa do Cine, 123</p>
                            <p class="text-muted">15001 A Coruña</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-phone text-danger fs-4"></i>
                        </div>
                        <div>
                            <h3 class="fs-5 fw-bold mb-2">Teléfono</h3>
                            <p class="text-muted">+34 698 171 329</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-envelope text-danger fs-4"></i>
                        </div>
                        <div>
                            <h3 class="fs-5 fw-bold mb-2">Correo electrónico</h3>
                            <p class="text-muted">larigerpe07@gmail.gal</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="far fa-clock text-danger fs-4"></i>
                        </div>
                        <div>
                            <h3 class="fs-5 fw-bold mb-2">Horario</h3>
                            <p class="text-muted mb-0">Luns a Venres: 16:00 - 23:00</p>
                            <p class="text-muted">Sábados e Domingos: 15:00 - 00:00</p>
                        </div>
                    </div>
                    
                    <h3 class="fs-5 fw-bold mb-3">Síguenos</h3>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/LariGerpe" class="btn btn-danger rounded-circle">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/larigerpee" class="btn btn-danger rounded-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com/lari_gerpee" class="btn btn-danger rounded-circle">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Formulario de Contacto -->
        <div class="col-lg-6"> <!-- columna a la derecha -->
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="fs-4 fw-bold mb-4">Envíanos unha mensaxe</h2>
                    
                    <form action="{{ route('contacto.send') }}" method="POST">
                        @csrf <!-- seguridad -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div> <!-- validación de Laravel -->
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Asunto</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Mensaxe</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-paper-plane me-2"></i> Enviar mensaxe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mapa de Ubicación -->
    <div class="card shadow-sm mb-5">
        <div class="card-body p-0">
            <div class="ratio ratio-21x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11667.883416039535!2d-8.40247545!3d43.3623419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e7cfcf174574d%3A0x6a47350d095cdfee!2sA%20Coru%C3%B1a%2C%20Spain!5e0!3m2!1sen!2sus!4v1621512345678!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    
    <!-- Sección de preguntas frecuentes -->
    <section>
        <h2 class="fs-3 fw-bold mb-4">Preguntas frecuentes</h2>
        
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="fs-5 fw-bold mb-2">¿Cómo podo reservar entradas?</h3>
                        <p class="text-muted mb-0">
                            Podes reservar entradas a través da nosa web, na sección de cartelera ou directamente na taquilla do
                            cine.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="fs-5 fw-bold mb-2">¿Hai desconto para estudantes?</h3>
                        <p class="text-muted mb-0">
                            Si, ofrecemos un desconto do 20% para estudantes con carné válido. Tamén temos descontos para maiores de
                            65 anos.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="fs-5 fw-bold mb-2">¿Podo cancelar unha reserva?</h3>
                        <p class="text-muted mb-0">
                            As reservas poden cancelarse ata 2 horas antes da función. Contacta con nós por teléfono ou email para
                            xestionar a cancelación.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="fs-5 fw-bold mb-2">¿Hai aparcamento dispoñible?</h3>
                        <p class="text-muted mb-0">
                            Contamos cun aparcamento propio con 100 prazas dispoñibles para os nosos clientes, gratuíto durante as 3
                            primeiras horas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection