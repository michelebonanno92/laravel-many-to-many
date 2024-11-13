<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

// Models 
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tolti i vincoli della chiave esterna nel Seeder Type  senza togliere lo svuotamento
        Schema::withoutForeignKeyConstraints(function () {
            Type::truncate();
        });

        // Type::truncate();

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
