<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddAgentTableRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $role = [
            ['name' => 'agent', 'display_name' => 'Agent']
        ];

        DB::table('roles')->insert($role);
    }
}
