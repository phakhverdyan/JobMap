<?php

use Illuminate\Database\Seeder;

class BusinessesUnconfirmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BusinessUnconfirmedKeywordsSeeder::class,
        ]);

        DB::table('businesses_unconfirmed')->delete();
        DB::statement('ALTER TABLE businesses_unconfirmed AUTO_INCREMENT = 1');
        DB::table('business_unconfirmed_locations')->delete();
        DB::statement('ALTER TABLE business_unconfirmed_locations AUTO_INCREMENT = 1');
        DB::table('business_unconfirmed_phones')->delete();
        DB::statement('ALTER TABLE business_unconfirmed_phones AUTO_INCREMENT = 1');

        for ($i = 1; $i <= 5; $i++) {
            $businessId = DB::table('businesses_unconfirmed')->insertGetId([
                'name' => 'business_un_' . $i,
                'slug' => 'business_un_' . $i,
                'keyword_id' => rand(1,2),
                'latitude' => rand(25,60),
                'longitude' => rand(-125,-70)
            ]);
            for ($j = 1; $j <= rand(1,3); $j++) {
                DB::table('business_unconfirmed_locations')->insert([
                    'business_unconfirmed_id' => $businessId,
                    'name' => 'location_' . $i . '_' . $j,
                    'latitude' => rand(25,60),
                    'longitude' => rand(-125,-70)
                ]);
            }
            for ($l = 1; $l <= rand(1,3); $l++) {
                DB::table('business_unconfirmed_phones')->insert([
                    'business_unconfirmed_id' => $businessId,
                    'value' => 'phone_' . $i . '_' . $l,
                ]);
            }
        }

    }
}
