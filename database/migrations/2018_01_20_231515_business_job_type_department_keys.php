<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobTypeDepartmentKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_departments', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('department_id')->unsigned()->change();
            $table->foreign('department_id')->references('id')->on('business_departments')->onDelete('cascade');
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
        Schema::table('business_job_departments', function ($table) {
            $table->dropForeign('business_job_departments_job_id_foreign');
            $table->dropIndex('business_job_departments_job_id_foreign');
            $table->dropForeign('business_job_departments_department_id_foreign');
            $table->dropIndex('business_job_departments_department_id_foreign');
        });
        Schema::table('business_job_departments', function (BluePrint $table) {
            $table->integer('department_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
