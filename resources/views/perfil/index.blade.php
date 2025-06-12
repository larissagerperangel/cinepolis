@extends('layouts.app')

@section('title', 'O meu perfil')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">O meu perfil</h1>
    <div class="card shadow-sm p-4">
        <p><strong>Nome:</strong> {{ $user->name }}</p> <!-- nombre de perfil -->
        <p><strong>Correo:</strong> {{ $user->email }}</p> <!-- correo de registro -->
    </div>
</div>
@endsection
