<header class="bg-white border-bottom shadow-sm sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-film text-danger me-2"></i>
                <span class="fw-bold fs-4">Cinépolis</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-danger' : '' }}" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cartelera') ? 'active fw-bold text-danger' : '' }}" href="{{ route('cartelera') }}">Cartelera</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('eventos') ? 'active fw-bold text-danger' : '' }}" href="{{ route('eventos') }}">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active fw-bold text-danger' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-danger" href="{{ route('cartelera') }}">Compra a túa entrada</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>