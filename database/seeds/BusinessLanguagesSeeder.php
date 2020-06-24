<?php

use Illuminate\Database\Seeder;

class BusinessLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = \App\Business::query()->get()->all();
        DB::table('business_languages')->delete();
        if ($businesses) {
            $insert = [];
            foreach ($businesses as $business) {
                $insert[] = [
                    'business_id' => $business['id'],
                    'language_id' => 1,
                    'status' => 1
                ];
            }
            
            DB::table('business_languages')->insert($insert);
        }
    }
}
