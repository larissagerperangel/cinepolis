<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Database\Seeder;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = Movie::all();
        
        foreach ($movies as $movie) {
            $times = ['16:30', '19:00', '21:30'];
            
            foreach ($times as $time) {
                // Creo horarios para hoy, mañana y pasado mañana
                for ($day = 0; $day < 3; $day++) {
                    Showtime::create([
                        'movie_id' => $movie->id,
                        'time' => $time,
                        'date' => now()->addDays($day)->format('Y-m-d'),
                        'room' => rand(1, 5),
                        'available_seats' => json_encode([]),
                    ]);
                }
            }
        }
    }
}
