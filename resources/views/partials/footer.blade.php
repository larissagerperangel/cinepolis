<footer class="bg-dark text-white py-4"> <!-- fondo oscuro, letra blanca, padding vertical -->
    <div class="container">
        <div class="row g-4">
            <!-- Logo y info -->
            <div class="col-md-6 col-lg-3"> <!-- sistema de rejilla Bootstrap con 4 columnas -->
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-film text-danger me-2"></i>
                    <span class="fw-bold fs-5">Cinépolis</span>
                </div>
                <p class="text small mb-3">O teu cine máis cerca, sempre ao teu ritmo.</p>
                <div class="mb-2 small">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    <span class="text">Rúa do Cine, 123, A Coruña</span>
                </div>
                <div class="mb-2 small">
                    <i class="fas fa-phone text-danger me-2"></i>
                    <span class="text">+34 698 171 329</span>
                </div>
                <div class="mb-2 small">
                    <i class="fas fa-envelope text-danger me-2"></i>
                    <span class="text">larigerpe07@gmail.com</span>
                </div>
            </div>
            
            <!-- Enlaces Rápidos, dentro de la página -->
            <div class="col-md-6 col-lg-3">
                <div>
                    <i class="fas fa-external-link text-danger me-2"></i>
                    <span class="mb-3 fs-6">Enlaces rápidos</span>
                </div>
                </br> 
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text small">Inicio</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cartelera') }}" class="text-decoration-none text small">Cartelera</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('eventos') }}" class="text-decoration-none text small">Eventos</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contacto') }}" class="text-decoration-none text small">Contacto</a>
                    </li>
                </ul>
            </div>
            
            <!-- Términos de legalidad -->
            <div class="col-md-6 col-lg-3">
                <div>
                    <i class="fas fa-gavel text-danger me-2"></i>
                    <span class="mb-3 fs-6">Legal</span>
                </div>
                </br> 
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="https://www.privacypolicies.com" target="_blank" rel="noopener" class="text-decoration-none text small">
                            Aviso legal
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://www.privacypolicies.com/privacy-policy-generator/" target="_blank" rel="noopener" class="text-decoration-none text small">
                            Política de privacidade
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://www.privacypolicies.com/cookies-policy-generator/" target="_blank" rel="noopener" class="text-decoration-none text small">
                            Política de cookies
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://www.privacypolicies.com/terms-conditions-generator/" target="_blank" rel="noopener" class="text-decoration-none text small">
                            Termos e condicións
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Subscripción -->
            <div class="col-md-6 col-lg-3">
                <div>
                    <i class="fas fa-newspaper text-danger me-2"></i>
                    <span class="mb-3 fs-6">Newsletter</span>
                </div>
                </br>   
                <p class="text small mb-3">Subscríbete para recibir as últimas novidades e promocións.</p>
                <form action="#" method="POST"> <!-- faltaría conectar el backend -->
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm bg-dark text-white" placeholder="O teu email" required>
                        <button type="submit" class="btn btn-danger btn-sm">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="text small mb-3 mb-md-0">
                &copy; {{ date('Y') }} Cinépolis. Todos os dereitos reservados.
            </p>
            <div class="d-flex gap-3">
                <a href="https://www.facebook.com/LariGerpe" target="_blank" rel="noopener" class="text">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/larigerpee" target="_blank" rel="noopener" class="text">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com/lari_gerpee" target="_blank" rel="noopener" class="text">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </div>
</footer>