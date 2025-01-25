<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class MovieUserSeeder extends Seeder
{
    public function run()
    {
        // Create users and movies
        $users = User::factory(10)->create(); // Assumes you have a UserFactory
        $movies = Movie::factory(20)->create();

        // Assign movies to users
        foreach ($users as $user) {
            $watchedMovies = $movies->random(rand(1, 5)); // Randomly pick 1-5 movies per user
            foreach ($watchedMovies as $movie) {
                $user->watchedMovies()->attach($movie->id, [
                    'watched_at' => now()->subDays(rand(1, 30)), // Random watched date
                ]);
            }
        }
    }
}
