<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessUnconfirmedLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_unconfirmed_locations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('business_unconfirmed_id')->unsigned();
            $table->foreign('business_unconfirmed_id')->references('id')->on('businesses_unconfirmed')->onDelete('cascade');

            $table->string('name', 255);
            $table->string('street', 255)->nullable();
            $table->string('street_number', 255)->nullable();
            $table->decimal('latitude', 10, 8)->default(0);
            $table->decimal('longitude', 10, 8)->default(0);
            $table->string('suite', 255)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('phone_country_code', 16)->nullable();
            $table->string('phone_code', 16)->nullable();
            $table->string('phone', 16)->nullable();

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
        Schema::dropIfExists('business_unconfirmed_locations');
    }
}
