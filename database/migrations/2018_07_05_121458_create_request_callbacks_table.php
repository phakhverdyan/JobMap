<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_callbacks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('contact_name');
            $table->string('employer_name');
            $table->integer('employer_number');
            $table->integer('location_number');
            $table->string('phone');
            $table->string('extension');
            $table->longText('message');
            $table->string('time');
            $table->string('country');

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
        Schema::dropIfExists('request_callbacks');
    }
}
