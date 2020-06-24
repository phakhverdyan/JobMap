<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('languages')->delete();
        DB::statement('ALTER TABLE languages AUTO_INCREMENT = 1');
        DB::table('languages')->insert([
            array(
                'name' => 'English',
                'prefix' => 'en',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Français',
                'prefix' => 'fr',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            /*array(
                'name' => 'Ukrainian',
                'prefix' => 'ua',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            ),
            array(
                'name' => 'Polish',
                'prefix' => 'pl',
                'created_at' => DB::raw('CURRENT_TIMESTAMP(0)'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP(0)')
            )*/
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
