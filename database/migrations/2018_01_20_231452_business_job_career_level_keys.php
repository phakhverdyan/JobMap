<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobCareerLevelKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_career_levels', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('career_id')->unsigned()->change();
            $table->foreign('career_id')->references('id')->on('career_levels')->onDelete('cascade');
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
        Schema::table('business_job_career_levels', function ($table) {
            $table->dropForeign('business_job_career_levels_job_id_foreign');
            $table->dropIndex('business_job_career_levels_job_id_foreign');
            $table->dropForeign('business_job_career_levels_career_id_foreign');
            $table->dropIndex('business_job_career_levels_career_id_foreign');
        });
        Schema::table('business_job_career_levels', function (BluePrint $table) {
            $table->integer('career_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
