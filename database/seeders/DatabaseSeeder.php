<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        
        User::factory()->create([
            'name' => 'Michele',
            'email' => 'michele@boolean.careers',
        ]);

        $this->call([
            PostSeeder::class,
            // richiamo prima TySeeder 
            TypeSeeder::class,
            ProjectSeeder::class,
            TechnologySeeder::class


        ]);
    }
}
