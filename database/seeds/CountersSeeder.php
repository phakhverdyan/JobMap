<?php

use Illuminate\Database\Seeder;

class CountersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counters')->delete();
        
        DB::statement("INSERT INTO `counters`(`id`, `employers`, `jobs_assign_open`, `jobs_assign_close`, `jobs_open`, `jobs_close`, `headquarters`, `locations`, `keywords`) VALUES (1,
(SELECT COUNT(*) FROM `businesses`),
(SELECT COUNT(DISTINCT job_id) FROM `business_job_locations` WHERE `status` = 1),
(SELECT COUNT(DISTINCT job_id) FROM `business_job_locations` WHERE `status` = 0),
(SELECT COUNT(*) FROM `business_jobs` WHERE `status` = 1),
(SELECT COUNT(*) FROM `business_jobs` WHERE `status` = 0),
(SELECT COUNT(*) FROM `business_locations` WHERE `type` = 'headquarter'),
(SELECT COUNT(*) FROM `business_locations` WHERE `type` = 'location'),
(SELECT COUNT(*) FROM `keywords`));");
    }
}
