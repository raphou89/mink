<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtenez les IDs de tous les types et races
        $typeIds = DB::table('types')->pluck('id')->toArray();
        $raceIds = DB::table('races')->pluck('id')->toArray();

        // Exemple de données d'animaux
        $animals = [
            [
                'name' => 'Bella',
                'age' => 3,
                'type_id' => $typeIds[array_rand($typeIds)],
                'race_id' => $raceIds[array_rand($raceIds)],
                'description' => 'Un adorable labrador.',
                'price' => 500,
                'status' => 'en vente',
                'pictures' => json_encode(['/storage/animals/labrador.png']),
            ],
            [
                'name' => 'Max',
                'age' => 5,
                'type_id' => $typeIds[array_rand($typeIds)],
                'race_id' => $raceIds[array_rand($raceIds)],
                'description' => 'Un cheval frison robuste.',
                'price' => 1500,
                'status' => 'en vente',
                'pictures' => json_encode(['/storage/animals/frison.png']),
            ],
        ];

        // Insertion des animaux dans la table
        foreach ($animals as $animal) {
            DB::table('animals')->insert($animal);
        }
    }
}
