<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index() // Muestro el formulario del contacto, en la sección de contacto
    {
        return view('contacto');
    }
    
    public function send(Request $request)
    {
        $request->validate([ // Valido los datos del contacto
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Redirecciono los emails (a mi correo)
        Mail::to('larigerpe07@gmail.com')->send(new ContactFormMail($request->all()));
        
        return back()->with('success', 'Mensaxe enviada con éxito. Recibirás unha resposta en breve.'); // Devuelvo un mensaje de exisito al enviar el formulario
    }
}