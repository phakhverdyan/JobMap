<?php

use Illuminate\Database\Seeder;

class BusinessUnconfirmedKeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_unconfirmed_keywords')->delete();
        DB::statement('ALTER TABLE business_unconfirmed_keywords AUTO_INCREMENT = 1');

        DB::table('business_unconfirmed_keywords')->insert([
            [ 'name' => 'Professional Services' ],
            [ 'name' => 'Security Services' ],
        ]);
    }
}
