<?php

use Illuminate\Database\Seeder;

class BusinessSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_sizes')->delete();
        DB::statement('ALTER TABLE business_sizes AUTO_INCREMENT = 1');

        DB::table('business_sizes')->insert([
            array(
                'name' => '1-5'
            ),
            array(
                'name' => '5-10'
            ),
            array(
                'name' => '10-25'
            ),
            array(
                'name' => '25-100'
            ),
            array(
                'name' => '100-500'
            ),
            array(
                'name' => '500-2000'
            ),
            array(
                'name' => '2000-5000'
            ),
            array(
                'name' => '5000-10000'
            ),
            array(
                'name' => '10000+'
            )
        ]);
    }
}