<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessLocationAmenityKeys extends Migration
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
            $table->integer('amenity_id')->unsigned()->change();
            $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
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
            $table->dropForeign('business_location_amenities_amenity_id_foreign');
            $table->dropIndex('business_location_amenities_amenity_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
