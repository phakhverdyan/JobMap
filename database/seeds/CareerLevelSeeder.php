<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareerLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('career_levels')->delete();
        DB::statement('ALTER TABLE career_levels AUTO_INCREMENT = 1');

        $data = [
            [ "key" => "student", "name" => "Student", "name_fr" => "Étudiant" ],
            [ "key" => "entry", "name" => "Entry-Level", "name_fr" => "Niveaudentrée" ],
            [ "key" => "intermediate", "name" => "Intermediate", "name_fr" => "Intermédiaire" ],
            [ "key" => "middle", "name" => "MiddleManagement", "name_fr" => "Cadresintermédiaires" ],
            [ "key" => "upper", "name" => "UpperManagement", "name_fr" => "Hautedirection" ],
            [ "key" => "executive", "name" => "Executive", "name_fr" => "Exécutif" ],
            /*[ "key" => "custom", "name" => "Custom", "name_fr" => "Personnalisé" ],*/
        ];

        DB::table('career_levels')->insert($data);

        /*DB::table('career_levels')->insert([
            array(
                'name' => 'Student',
                'key' => 'student',
            ),
            array(
                'name' => 'Entry-Level',
                'key' => 'entry',
            ),
            array(
                'name' => 'Intermediate',
                'key' => 'intermediate',
            ),
            array(
                'name' => 'Middle Management',
                'key' => 'middle',
            ),
            array(
                'name' => 'Upper Management',
                'key' => 'upper',
            ),
            array(
                'name' => 'Executive',
                'key' => 'executive',
            ),
            array(
                'name' => 'Custom',
                'key' => 'custom',
            )
            
        ]);*/
    }
}
