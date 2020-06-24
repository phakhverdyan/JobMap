<?php

use Illuminate\Database\Seeder;

class MonthlyPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monthly_plans')->delete();
        $data = [
            ['order' => 1, 'applicants' => 10, 'price' => 5, 'plan_name' => '1 Plan'],
            ['order' => 2, 'applicants' => 50, 'price' => 25, 'plan_name' => '2 Plan'],
            ['order' => 3, 'applicants' => 100, 'price' => 45, 'plan_name' => '3 Plan'],
            ['order' => 4, 'applicants' => 150, 'price' => 65, 'plan_name' => '4 Plan'],
            ['order' => 5, 'applicants' => 200, 'price' => 85, 'plan_name' => '5 Plan'],
            ['order' => 6, 'applicants' => 400, 'price' => 99, 'plan_name' => '6 Plan'],
        ];
        DB::table('monthly_plans')->insert($data);
    }
}