<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessDepartmentLocationKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_department_locations', function ($table) {
            $table->integer('department_id')->unsigned()->change();
            $table->foreign('department_id')->references('id')->on('business_departments')->onDelete('cascade');
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
        Schema::table('business_department_locations', function ($table) {
            $table->dropForeign('business_department_locations_department_id_foreign');
            $table->dropIndex('business_department_locations_department_id_foreign');
            $table->dropForeign('business_department_locations_location_id_foreign');
            $table->dropIndex('business_department_locations_location_id_foreign');
        });
        Schema::table('business_department_locations', function (BluePrint $table) {
            $table->integer('location_id')->change();
            $table->integer('department_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
