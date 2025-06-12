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

                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link border border-danger rounded" href="#" id="navbarDropdown" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false"  style="color:white;">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}">O meu perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('reservas') }}">As miñas reservas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Pechar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active fw-bold text-danger' : '' }}" 
                        href="{{ route('login') }}" style="color:white;">
                            <i class="fas fa-sign-in-alt me-1"></i> Iniciar sesión
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>