<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessUnconfirmedPhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_unconfirmed_phones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('business_unconfirmed_id')->unsigned();
            $table->foreign('business_unconfirmed_id')->references('id')->on('businesses_unconfirmed')->onDelete('cascade');

            $table->string('value');

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
        Schema::dropIfExists('business_unconfirmed_phones');
    }
}
