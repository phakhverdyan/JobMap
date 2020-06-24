<?php

use Illuminate\Database\Seeder;

class AddDataDBSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            IndustrySeeder::class,
            JobCategorySeeder::class,
            DegreesSeeder::class,
            FieldsOfStudySeeder::class,
            SkillsSeeder::class,
            LanguagesSeeder::class,
            WorldLanguage::class,
            CertificationsSeeder::class,
            InterestsSeeder::class,
            AmenitiesTableSeeder::class,
            JobTypesSeeder::class,
            CareerLevelSeeder::class,
            GradesSeeder::class,

        ]);


    }
}