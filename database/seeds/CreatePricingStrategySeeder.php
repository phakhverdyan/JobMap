<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePricingStrategySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert Admin
        DB::table('pricing_strategy')->delete();
        DB::statement('ALTER TABLE pricing_strategy AUTO_INCREMENT = 1');

        DB::table('pricing_strategy')->insert([
            'monthly_price' => 25,
            'candidates' => 100,
            'free_version_candidates' => 25,
            'active' => 1
        ]);
    }

}
