<header class="bg-dark shadow-sm sticky-top"> <!-- fondo oscuro, ligero sombreado, y cabecera siempre fija -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-film text-danger me-2"></i>
                <span class="fw-bold fs-4" style="color:white">Cinépolis</span>
            </a>
            
            <!-- Botón para abrir/cerra menú de navegación en el móbil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Barra de navegación -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-danger' : '' }}" href="{{ route('home') }}" style="color:white">Inicio</a> <!-- verifica si estás en la ruta actual, y aplica estilos --> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cartelera') ? 'active fw-bold text-danger' : '' }}" href="{{ route('cartelera') }}" style="color:white">Cartelera</a> <!-- cuando entras se pone en rojo y en negrita, si no blanco -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('eventos') ? 'active fw-bold text-danger' : '' }}" href="{{ route('eventos') }}" style="color:white">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active fw-bold text-danger' : '' }}" href="{{ route('contacto') }}" style="color:white">Contacto</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-danger" href="{{ route('cartelera') }}">Compra a túa entrada</a> <!-- botón rojo destacado, redirige a la cartelera -->
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>