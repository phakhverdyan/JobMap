<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('user_id');
            $table->string('name', 255);
            $table->string('street', 255);
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 10, 8)->default(0);
            $table->string('suite', 255);
            $table->string('city', 64);
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('phone_country_code', 16)->nullable();
            $table->string('phone_code', 16)->nullable();
            $table->string('phone', 16);
            $table->enum('type', [
                'location',
                'headquarter'
            ])->default('location');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses_locations');
    }
}
