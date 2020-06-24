<?php

use App\Modules\Admin\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tickets')->delete();
        DB::table('tickets')->insert([
            'client_id' => 1,
            'business_id' => 1,
            'status' => 'Unassigned',
            'title' => 'Title',
            'admin_user_id' => 1,
            'priority' => 'high',
            'department_id' => 1,
        ]);

    }
}
