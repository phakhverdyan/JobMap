<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCounterJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_new_jobs AFTER INSERT ON business_jobs FOR EACH ROW
            BEGIN
                IF NEW.status = 1 THEN BEGIN
                    UPDATE counters SET jobs_open = jobs_open+1;
                    END;
                END IF;
                IF NEW.status = 0 THEN BEGIN
                    UPDATE counters SET jobs_close = jobs_close+1;
                    END;
                END IF;
            END
        ');
        
        DB::unprepared('
        CREATE TRIGGER trigger_update_jobs AFTER UPDATE ON business_jobs FOR EACH ROW
            BEGIN
                IF OLD.status = 1 AND NEW.status = 0 THEN BEGIN
                    UPDATE counters SET jobs_open = jobs_open-1;
                    UPDATE counters SET jobs_close = jobs_close+1;
                    END;
                END IF;
                IF OLD.status = 0 AND NEW.status = 1 THEN BEGIN
                    UPDATE counters SET jobs_open = jobs_open+1;
                    UPDATE counters SET jobs_close = jobs_close-1;
                    END;
                END IF;
            END
        ');
        
        DB::unprepared('
        CREATE TRIGGER trigger_delete_jobs BEFORE DELETE ON business_jobs FOR EACH ROW
            BEGIN
                IF OLD.status = 1 THEN BEGIN
                    UPDATE counters SET jobs_open = jobs_open-1;
                    END;
                END IF;
                IF OLD.status = 0 THEN BEGIN
                    UPDATE counters SET jobs_close = jobs_close-1;
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
        DB::unprepared('DROP TRIGGER `trigger_new_jobs`');
        DB::unprepared('DROP TRIGGER `trigger_update_jobs`');
        DB::unprepared('DROP TRIGGER `trigger_delete_jobs`');
    }
}
