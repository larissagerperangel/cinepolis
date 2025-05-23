<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory; // permitir crear instancias con datos de prueba facilmente (seeders)

    protected $fillable = [ // defino los campos que se van a generar al crear un evento
        'title',
        'description',
        'date',
        'time',
        'room',
        'price',
        'image',
    ];

    protected $casts = [ // convierto los campos cuando se recuperan de la BD
        'date' => 'date',
    ];
}