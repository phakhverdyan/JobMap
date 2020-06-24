<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlagshipCoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flagship_coefficient')->delete();
        $role = [
            ['coefficient' => 1]
        ];

        DB::table('flagship_coefficient')->insert($role);
    }
}
