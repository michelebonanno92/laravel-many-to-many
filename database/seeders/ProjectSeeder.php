<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models 
use App\Models\Project;
use App\Models\Type;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        for ($i = 0; $i < 10; $i++) {
            $name = fake()->sentence();

            Project::create([
                'name' => $name,
                'slug' => str()->slug($name),
                // utilizzato Model Type con il count() associzmo ad ogni elemento della tabella type ad ogni numero casuale con il rand
                'type_id' => rand(1,Type::count()),

            ]);
        }
    }
}
