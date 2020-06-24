<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerCounterJobsAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_new_jobs_assign BEFORE INSERT ON business_job_locations FOR EACH ROW
            BEGIN
                DECLARE cnt INT;
                SET cnt = (SELECT COUNT(*) FROM business_job_locations WHERE
                            job_id = NEW.job_id AND status = NEW.status);
                IF cnt = 0 THEN
                    IF NEW.status = 1 THEN
                        UPDATE counters SET jobs_assign_open = jobs_assign_open+1;
                    END IF;
                    IF NEW.status = 0 THEN
                        UPDATE counters SET jobs_assign_close = jobs_assign_close+1;
                    END IF;
                END IF;
            END
        ');
        
        DB::unprepared('
        CREATE TRIGGER trigger_update_jobs_assign AFTER UPDATE ON business_job_locations FOR EACH ROW
            BEGIN
                DECLARE cntOld INT;
                DECLARE cntNew INT;
                SET cntOld = (SELECT COUNT(*) FROM business_job_locations WHERE
                            job_id = OLD.job_id AND status = OLD.status);
                SET cntNew = (SELECT COUNT(*) FROM business_job_locations WHERE
                            job_id = NEW.job_id AND status = NEW.status);
                IF cntNew = 1 THEN
                    IF NEW.status = 1 THEN
                        UPDATE counters SET jobs_assign_open = jobs_assign_open+1;
                    END IF;
                    IF NEW.status = 0 THEN
                        UPDATE counters SET jobs_assign_close = jobs_assign_close+1;
                    END IF;
                END IF;
                IF cntOld = 0 THEN
                    IF OLD.status = 1 THEN
                        UPDATE counters SET jobs_assign_open = jobs_assign_open-1;
                    END IF;
                    IF OLD.status = 0 THEN
                        UPDATE counters SET jobs_assign_close = jobs_assign_close-1;
                    END IF;
                END IF;
            END
        ');
        
        DB::unprepared('
        CREATE TRIGGER trigger_delete_jobs_assign AFTER DELETE ON business_job_locations FOR EACH ROW
            BEGIN
                DECLARE cntOld INT;
                SET cntOld = (SELECT COUNT(*) FROM business_job_locations WHERE
                            job_id = OLD.job_id AND status = OLD.status);
                IF cntOld = 0 THEN
                    IF OLD.status = 1 THEN
                        UPDATE counters SET jobs_assign_open = jobs_assign_open-1;
                    END IF;
                    IF OLD.status = 0 THEN
                        UPDATE counters SET jobs_assign_close = jobs_assign_close-1;
                    END IF;
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
        DB::unprepared('DROP TRIGGER `trigger_new_jobs_assign`');
        DB::unprepared('DROP TRIGGER `trigger_update_jobs_assign`');
        DB::unprepared('DROP TRIGGER `trigger_delete_jobs_assign`');
    }
}
