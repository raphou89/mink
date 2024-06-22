<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array des races à insérer
        $races = [
            ['name' => 'labrador'],
            ['name' => 'frison'],
            ['name' => 'pottok'],
            ['name' => 'irish cob'],
            ['name' => 'mérinos'],
            ['name' => 'solognotes'],
        ];

        // Insertion des races dans la table
        DB::table('races')->insert($races);
    }
}
