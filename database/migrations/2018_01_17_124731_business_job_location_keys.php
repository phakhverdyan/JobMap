<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobLocationKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_locations', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('location_id')->unsigned()->change();
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_locations', function ($table) {
            $table->dropForeign('business_job_locations_job_id_foreign');
            $table->dropIndex('business_job_locations_job_id_foreign');
            $table->dropForeign('business_job_locations_location_id_foreign');
            $table->dropIndex('business_job_locations_location_id_foreign');
        });
        Schema::table('business_job_locations', function (BluePrint $table) {
            $table->integer('location_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
