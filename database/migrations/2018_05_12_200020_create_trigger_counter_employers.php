<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCounterEmployers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_new_employer AFTER INSERT ON businesses FOR EACH ROW
            BEGIN
                UPDATE counters SET employers = employers+1;
            END
        ');
        DB::unprepared('
        CREATE TRIGGER trigger_remove_employer AFTER DELETE ON businesses FOR EACH ROW
            BEGIN
                UPDATE counters SET employers = employers-1;
            END
        ');
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `trigger_new_employer`');
        DB::unprepared('DROP TRIGGER `trigger_remove_employer`');
    }
}
