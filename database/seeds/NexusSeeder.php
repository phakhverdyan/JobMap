<?php

use Illuminate\Database\Seeder;

class NexusSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AddAgentTableRoles::class,
            CreateAdminUsersSeeder::class,
            TaxSeeder::class,
            FlagshipCoefficientSeeder::class,
            AddonPackagesTableSeeder::class,
            MonthlyPlansTableSeeder::class,
            TicketMessageTableSeeder::class,
            TicketsTableSeeder::class,
            CreateCountriesTableSeeder::class,
            CreatePricingStrategySeeder::class

        ]);


    }
}