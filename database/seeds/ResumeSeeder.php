<?php

use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the resume seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GradesSeeder::class,
            DegreesSeeder::class,
            FieldsOfStudySeeder::class,
            SkillsSeeder::class,
            CertificationsSeeder::class,
            InterestsSeeder::class,
            WorldLanguage::class
        ]);
    }
}
