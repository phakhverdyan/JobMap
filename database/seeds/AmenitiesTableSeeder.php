<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amenities')->delete();
        DB::statement('ALTER TABLE amenities AUTO_INCREMENT = 1');

        $data = [
            [ "key" => "social", "name" => "Social benefits ", "name_fr" => "Avantages sociaux" ],
            [ "key" => "kinder", "name" => "Kinder Garden ", "name_fr" => "Garderie au travail" ],
            [ "key" => "gym", "name" => "Gym friendly ", "name_fr" => "Gym au travail" ],
            [ "key" => "pension", "name" => "Pension fund ", "name_fr" => "Fonds de pension" ],
            [ "key" => "school", "name" => "School friendly ", "name_fr" => "Éducation" ],
            [ "key" => "pet", "name" => "Pet friendly ", "name_fr" => "animaux de compagnie au travail" ],
            [ "key" => "work", "name" => "Work/family balance ", "name_fr" => "Équilibre travail / famille" ],
            [ "key" => "parking", "name" => "Free parking ", "name_fr" => "Stationnement gratuit" ],
            [ "key" => "transport", "name" => "Public transport accessible", "name_fr" => "Transports publics accessibles" ],
            [ "key" => "vacation", "name" => "Vacation friendly ", "name_fr" => "Vacances" ],
        ];

        DB::table('amenities')->insert($data);


        // Insert
        /*DB::table('amenities')->insert([
            array(
                'name' => 'Social benefits',
                'key' => 'social',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Kinder Garden',
                'key' => 'kinder',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Gym friendly',
                'key' => 'gym',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Pension fund',
                'key' => 'pension',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'School friendly',
                'key' => 'school',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Pet friendly',
                'key' => 'pet',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Work/family balance',
                'key' => 'work',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Free parking',
                'key' => 'parking',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Public transport accessible',
                'key' => 'transport',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Vacation friendly',
                'key' => 'vacation',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            )
        ]);*/
    }
}
