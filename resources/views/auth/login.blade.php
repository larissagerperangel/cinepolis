@extends('layouts.app')

@section('title', 'Iniciar Sesión - Cinépolis')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h1 class="fs-3 fw-bold text-center mb-0">
                        <i class="fas fa-film text-danger me-2"></i> Accede á túa conta
                    </h1>
                </div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contrasinal</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" 
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Lembrar sesión
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link text-decoration-none text-center" 
                               href="{{ route('password.request') }}">
                                Esqueciches o teu contrasinal?
                            </a>
                            @endif
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <p class="mb-2">Aínda non tes conta?</p>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-user-plus me-2"></i> Rexístrate
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection