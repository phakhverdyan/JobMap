<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AmenitiesTableSeeder::class,
            BusinessSizeSeeder::class,
            CareerLevelSeeder::class,
            //CreateCountriesTableSeeder::class,
            DepartmentsTableSeeder::class,
            IndustrySeeder::class,
            JobCategorySeeder::class,
            JobTypesSeeder::class,
            LanguagesSeeder::class,
            CountriesTableSeeder::class
        ]);
    }
}
