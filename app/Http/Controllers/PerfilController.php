<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user(); //  obtiene el usuario autenticado
        return view('perfil.index', compact('user')); // paso a la vista del perfil una variable llamada $user con los datos del usuario logueado
    }
}
