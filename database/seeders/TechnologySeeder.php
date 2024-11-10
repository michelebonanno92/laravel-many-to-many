<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Schema;


// Models
use App\Models\Technology;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Technology::truncate();

       
        for ($i = 0; $i < 10; $i++) {
            $name = fake()->sentence();
            $slug = str()->slug($name);

            Technology::create([
                'name' => $name,
                'slug' => str()->slug($name),
            ]);
         }
    }
}
