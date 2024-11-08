<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models 
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::truncate();
        
        $allTypes = [
            'Interno',
            'Esterno',
            'Di investimento',
            'Di ricerca ',
            'Di sviluppo'
        ];
        
        foreach ($allTypes as $singleType){
            // mi creo le istanze
            $type = Type::create([
                'title' => $singleType,
                'slug' => str()->slug($singleType),
            ]);
                

        }
    }
}
// con dati faker
// Type::truncate();

        // for ($i = 0; $i < 10; $i++) {
        //     $title = fake()->sentence();

        //     Type::create([
        //         'title' => $title,
        //         'slug' => str()->slug($title)
        //     ]);
        // }
