<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Maratón de Ciencia Ficción',
                'description' => 'Disfruta dunha noite completa coas mellores películas de ciencia ficción dos últimos anos. Inclúe sorpresas, aperitivo e máis...',
                'date' => '2025-06-19',
                'time' => '18:00 - 00:00',
                'room' => '1',
                'price' => '15€',
                'image' => 'event1.jpg',
            ],
            [
                'title' => 'Estrea exclusiva con director',
                'description' => 'Asiste á estrea exclusiva da película "Avengers: Doomsday" co seu director e elenco principal. Inclúe coloquio posterior e copa de benvida.',
                'date' => '2025-06-22',
                'time' => '20:00',
                'room' => 'VIP',
                'price' => '12€',
                'image' => 'event2.jpg',
            ],
            [
                'title' => 'Cine infantil: Mañás de domingo',
                'description' => 'Sesións especiais para os máis pequenos da casa con películas adaptadas e volume reducido. Inclúe animación antes da proxección.',
                'date' => '2025-06-26',
                'time' => '11:00',
                'room' => '2',
                'price' => '5€',
                'image' => 'event3.jpg',
            ],
            [
                'title' => 'Ciclo de cine clásico',
                'description' => 'Revisión das obras máis importantes da historia do cine, con presentacións de expertos e material restaurado. Unha oportunidade única para redescubrir o patrimonio audiovisual.',
                'date' => '2025-06-30',
                'time' => '19:00',
                'room' => '3',
                'price' => '7€ (abono completo 30€)',
                'image' => 'event4.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
