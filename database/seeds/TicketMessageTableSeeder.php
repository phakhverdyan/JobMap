<?php

use App\Modules\Admin\Models\TicketMessage;
use Illuminate\Database\Seeder;

class TicketMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_messages')->delete();
        DB::table('ticket_messages')->insert([
            'ticket_id' => 1,
            'agent_id' => 1,
            'client_id' => 0,
            'text' => 'Text',
            'type' =>'internal_note',
        ]);

    }
}
