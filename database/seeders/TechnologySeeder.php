<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;



// Models
use App\Models\Technology;
use App\Models\Project;



class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ogni volta che c'è una relazione esterna non possiamo effettuare normalmente il truncate() quindi si usa questa funzione per evitare l'errore
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });
        // Technology::truncate();

       
        for ($i = 0; $i < 10; $i++) {
            $name = fake()->sentence();
            $slug = str()->slug($name);

            $technology = Technology::create([
                'name' => $name,
                'slug' => str()->slug($name),
            ]);

            $projectIds = [];
            $projectsCount = Project::count();

            for ($j=0; $j < rand(0, $projectsCount); $j++) { 
                // così come secondo argomento di rand() prendo tutti i progetti che ci sono con direttamente il count 
                $randomProject = Project::inRandomOrder()->first();
                // poi con la funzione inRAndomOrder()first() prendo uno dei progetti in maniera cusuale prendendo il primo 
                if (!in_array($randomProject->id, $projectIds)) {
                    $projectIds[] = $randomProject->id;
                 }
                //  se non c'è l'id di $randomProject allora lo pusho nell'array $projeectIds 
                
                // una volta che ho popolato l'array con un project random posso fare: 
                $technology->projects()->sync($projectIds);
                // così quando sidderò prenderò un numero random di project e li sincronizzo con i technology con sync()
            }
         }
    }
}

