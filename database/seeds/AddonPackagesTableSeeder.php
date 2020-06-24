<?php

use Illuminate\Database\Seeder;

class AddonPackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addon_packages')->delete();
        $data = [
            ['order' => 1, 'applicants' => 10, 'price' => 5, 'plan_name' => '1 Plan addon'],
            ['order' => 2, 'applicants' => 50, 'price' => 50, 'plan_name' => '2 Plan addon'],
            ['order' => 3, 'applicants' => 100, 'price' => 100, 'plan_name' => '3 Plan addon'],
            ['order' => 4, 'applicants' => 150, 'price' => 150, 'plan_name' => '4 Plan addon'],
            ['order' => 5, 'applicants' => 200, 'price' => 200, 'plan_name' => '5 Plan addon'],
            ['order' => 6, 'applicants' => 400, 'price' => 400, 'plan_name' => '6 Plan addon'],
        ];
        DB::table('addon_packages')->insert($data);
    }
}