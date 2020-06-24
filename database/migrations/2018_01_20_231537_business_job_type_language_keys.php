<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobTypeLanguageKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_languages', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('world_language_id')->unsigned()->change();
            $table->foreign('world_language_id')->references('id')->on('world_languages')->onDelete('cascade');
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
        Schema::table('business_job_languages', function ($table) {
            $table->dropForeign('business_job_languages_job_id_foreign');
            $table->dropIndex('business_job_languages_job_id_foreign');
            $table->dropForeign('business_job_languages_world_language_id_foreign');
            $table->dropIndex('business_job_languages_world_language_id_foreign');
        });
        Schema::table('business_job_languages', function (BluePrint $table) {
            $table->integer('world_language_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
