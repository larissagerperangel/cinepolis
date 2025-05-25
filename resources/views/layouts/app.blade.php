<!DOCTYPE html>
<html lang="gl"> <!-- Idioma en gallego -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- diseño responsivo para móviles -->
    <title>@yield('title', 'Cinépolis - O teu cine máis cerca')</title> <!-- Valor de la sección del título, o el texto por defecto si no se define -->
    <meta name="description" content="Cinépolis - O teu cine máis cerca, sempre ao teu ritmo">
    
    <!-- Fuentes de GOOGLE, para que la conexión cargué más rápido y para definir el tipo de letra y su grosor -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Funte de CSS de las clases y los estilos predefinidos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fuente Awesome, para los iconos vectoriales  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- CSS Personalizado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles') <!-- Permite que otras vistas agreguen CSS usando "@"push('styles') -->
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Cabecera -->
        @include('partials.header')
        
        <!-- Contenido principal de cada página -->
        <main class="flex-grow-1">
            @yield('content')
        </main>
        
        <!-- Pie de página -->
        @include('partials.footer')
    </div>
    
    <!-- JS para agregar funcionalidades dinámicas y interactivas a Bootstrap (como el carrusel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JS personalizado -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    @stack('scripts') <!-- Permite que otras vistas inserten JS usando "@"push('scripts') -->
</body>
</html>