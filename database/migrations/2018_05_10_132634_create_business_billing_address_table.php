<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBillingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_billing_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->string('company_name');
            $table->string('owner_name');
            $table->string('street_number');
            $table->string('street');
            $table->string('suite');
            $table->string('city');
            $table->string('region');
            $table->string('country');
            $table->string('country_code');
            $table->string('zip_code');
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
        Schema::dropIfExists('business_billing_addresses');
    }
}
