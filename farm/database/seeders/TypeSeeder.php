<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array des types à insérer
        $types = [
            ['name' => 'chien'],
            ['name' => 'cheval'],
            ['name' => 'brebis'],
            ['name' => 'cochon'],
        ];

        // Insertion des types dans la table
        DB::table('types')->insert($types);
    }
}
