<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessLocationsAmenityKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_location_amenities', function ($table) {
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
        Schema::table('business_location_amenities', function ($table) {
            $table->dropForeign('business_location_amenities_location_id_foreign');
            $table->dropIndex('business_location_amenities_location_id_foreign');
        });
        Schema::table('business_location_amenities', function (BluePrint $table) {
            $table->integer('location_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
