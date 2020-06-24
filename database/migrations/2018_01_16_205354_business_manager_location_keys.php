<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessManagerLocationKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_manager_locations', function ($table) {
            $table->integer('administrator_id')->unsigned()->change();
            $table->foreign('administrator_id')->references('id')->on('business_administrators')->onDelete('cascade');
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
        Schema::table('business_manager_locations', function ($table) {
            $table->dropForeign('business_manager_locations_administrator_id_foreign');
            $table->dropIndex('business_manager_locations_administrator_id_foreign');
            $table->dropForeign('business_department_locations_location_id_foreign');
            $table->dropIndex('business_department_locations_location_id_foreign');
        });
        Schema::table('business_manager_locations', function (BluePrint $table) {
            $table->integer('location_id')->change();
            $table->integer('administrator_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
