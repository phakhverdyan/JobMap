<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleJobsUpdatedToBusinessJobLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_job_locations', function (Blueprint $table) {
            $table->integer('google_jobs_notified')->unsigned()->after('opened_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_job_locations', function (Blueprint $table) {
            $table->dropColumn('google_jobs_notified');
        });
    }
}
