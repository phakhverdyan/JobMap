<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobTypeKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_types', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('type_id')->unsigned()->change();
            $table->foreign('type_id')->references('id')->on('job_types')->onDelete('cascade');
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
        Schema::table('business_job_types', function ($table) {
            $table->dropForeign('business_job_types_job_id_foreign');
            $table->dropIndex('business_job_types_job_id_foreign');
            $table->dropForeign('business_job_types_type_id_foreign');
            $table->dropIndex('business_job_types_type_id_foreign');
        });
        Schema::table('business_job_types', function (BluePrint $table) {
            $table->integer('type_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
