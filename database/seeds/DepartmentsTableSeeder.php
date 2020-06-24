<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();
        $departments = [
            ['name' => 'sales', 'display_name' =>'Sales'],
            ['name' => 'support', 'display_name' =>'Support'],
            ['name' => 'technical', 'display_name' =>'Technical'],
            ['name' => 'billing', 'display_name' =>'Billing'],
            ['name' => 'finance', 'display_name' =>'Finance'],
            ['name' => 'retention', 'display_name' =>'Retention']
        ];

        DB::table('departments')->insert($departments);
    }
}
