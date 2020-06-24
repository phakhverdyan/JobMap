<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCounterLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_new_location AFTER INSERT ON business_locations FOR EACH ROW
            BEGIN
                IF NEW.type = "headquarter" THEN BEGIN
                    UPDATE counters SET headquarters = headquarters+1;
                    END;
                END IF;
                IF NEW.type = "location" THEN BEGIN
                    UPDATE counters SET locations = locations+1;
                    END;
                END IF;
            END
        ');
    
        DB::unprepared('
        CREATE TRIGGER trigger_update_location AFTER UPDATE ON business_locations FOR EACH ROW
            BEGIN
                IF OLD.type = "headquarter" AND NEW.type = "location" THEN BEGIN
                    UPDATE counters SET headquarters = headquarters-1;
                    UPDATE counters SET locations = locations+1;
                    END;
                END IF;
                IF OLD.type = "location" AND NEW.type = "headquarter" THEN BEGIN
                    UPDATE counters SET headquarters = headquarters+1;
                    UPDATE counters SET locations = locations-1;
                    END;
                END IF;
            END
        ');
    
        DB::unprepared('
        CREATE TRIGGER trigger_delete_location BEFORE DELETE ON business_locations FOR EACH ROW
            BEGIN
                IF OLD.type = "headquarter" THEN BEGIN
                    UPDATE counters SET headquarters = headquarters-1;
                    END;
                END IF;
                IF OLD.type = "location" THEN BEGIN
                    UPDATE counters SET locations = locations-1;
                    END;
                END IF;
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
        DB::unprepared('DROP TRIGGER `trigger_new_location`');
        DB::unprepared('DROP TRIGGER `trigger_update_location`');
        DB::unprepared('DROP TRIGGER `trigger_delete_location`');
    }
}
