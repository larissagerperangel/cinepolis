<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row g-4">
            <!-- Logo and info -->
            <div class="col-md-6 col-lg-3">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-film text-danger me-2"></i>
                    <span class="fw-bold fs-5">Cinépolis</span>
                </div>
                <p class="text-muted small mb-3">O teu cine máis cerca, sempre ao teu ritmo.</p>
                <div class="mb-2 small">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    <span class="text-muted">Rúa do Cine, 123, A Coruña</span>
                </div>
                <div class="mb-2 small">
                    <i class="fas fa-phone text-danger me-2"></i>
                    <span class="text-muted">+34 981 123 456</span>
                </div>
                <div class="mb-2 small">
                    <i class="fas fa-envelope text-danger me-2"></i>
                    <span class="text-muted">info@cinepolis.gal</span>
                </div>
            </div>
            
            <!-- Quick links -->
            <div class="col-md-6 col-lg-3">
                <h5 class="mb-3 fs-6">Enlaces rápidos</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted small">Inicio</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cartelera') }}" class="text-decoration-none text-muted small">Cartelera</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('eventos') }}" class="text-decoration-none text-muted small">Eventos</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contacto') }}" class="text-decoration-none text-muted small">Contacto</a>
                    </li>
                </ul>
            </div>
            
            <!-- Legal -->
            <div class="col-md-6 col-lg-3">
                <h5 class="mb-3 fs-6">Legal</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-muted small">Aviso legal</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-muted small">Política de privacidade</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-muted small">Política de cookies</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-decoration-none text-muted small">Termos e condicións</a>
                    </li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="col-md-6 col-lg-3">
                <h5 class="mb-3 fs-6">Newsletter</h5>
                <p class="text-muted small mb-3">Subscríbete para recibir as últimas novidades e promocións.</p>
                <form action="#" method="POST">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="O teu email" required>
                        <button type="submit" class="btn btn-danger btn-sm">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr class="my-4 border-secondary">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="text-muted small mb-3 mb-md-0">
                &copy; {{ date('Y') }} Cinépolis. Todos os dereitos reservados.
            </p>
            <div class="d-flex gap-3">
                <a href="#" class="text-muted">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-muted">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-muted">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </div>
</footer>