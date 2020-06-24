<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCounterKeywords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_new_keyword AFTER INSERT ON keywords FOR EACH ROW
            BEGIN
                UPDATE counters SET keywords = keywords+1;
            END
        ');
        DB::unprepared('
        CREATE TRIGGER trigger_remove_keyword AFTER DELETE ON keywords FOR EACH ROW
            BEGIN
                UPDATE counters SET keywords = keywords-1;
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
        DB::unprepared('DROP TRIGGER `trigger_new_keyword`');
        DB::unprepared('DROP TRIGGER `trigger_remove_keyword`');
    }
}
