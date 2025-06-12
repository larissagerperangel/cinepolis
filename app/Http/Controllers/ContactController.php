<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        
        // Guardar el mensaje en los logs para revisión
        Log::info('Nuevo mensaje de contacto', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'timestamp' => now()
        ]);
        
        // Aquí puedes implementar el envío real de email más tarde
        // Por ahora, solo simulamos el envío exitoso
        
        return back()->with('success', 'Mensaxe enviada con éxito. Recibirás unha resposta en breve.'); // Devuelvo un mensaje de exisito al enviar el formulario
    }
}