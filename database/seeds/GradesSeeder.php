<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        DB::statement('ALTER TABLE grades AUTO_INCREMENT = 1');

        $data = [
            [ "title" => "Secondary", "title_fr" => "Secondaire" ],
            [ "title" => "College", "title_fr" => "Université" ],
            [ "title" => "Senior secondary", "title_fr" => "Deuxième cycle du secondaire" ],
            [ "title" => "General basic", "title_fr" => "Général de base" ],
            [ "title" => "General secondary", "title_fr" => "Secondaire général" ],
            [ "title" => "Junior secondary", "title_fr" => "Junior secondaire" ],
            [ "title" => "Senior high", "title_fr" => "Senior senior" ],
            [ "title" => "Junior high", "title_fr" => "Junior haut" ],
            [ "title" => "Cégep", "title_fr" => "Cégep" ],
            [ "title" => "Lycée", "title_fr" => "Lycée" ],
            [ "title" => "Junior cycle", "title_fr" => "Cycle junior" ],
            [ "title" => "Senior cycle", "title_fr" => "Cycle senior" ],
            [ "title" => "Junior certificate", "title_fr" => "Certificat pour mineur" ],
            [ "title" => "Leaving certificate", "title_fr" => "Certificat de départ" ],
            [ "title" => "Lower secondary", "title_fr" => "Secondaire inférieur" ],
            [ "title" => "Higher secondary", "title_fr" => "Secondaire supérieur" ],
            [ "title" => "Pre-university programme", "title_fr" => "Programme pré-universitaire" ],
            [ "title" => "Upper secondary", "title_fr" => "Secondaire supérieur" ],
            [ "title" => "Junior higher secondary", "title_fr" => "Junior supérieur" ],
            [ "title" => "Senior higher secondary", "title_fr" => "Secondaire supérieur" ],
        ];

        DB::table('grades')->insert($data);
    }
}
