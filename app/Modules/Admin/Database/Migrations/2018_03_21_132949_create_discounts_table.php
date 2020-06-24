<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 250);
            $table->string('code', 190)->unique();

            $table->unsignedInteger('off_an_locations_value');
            $table->enum('off_an_locations_type', ['$', '%']);

            $table->unsignedInteger('off_on_seats_value');
            $table->enum('off_on_seats_type', ['$', '%']);

            $table->unsignedInteger('off_on_month_value');
            $table->enum('off_on_month_type', ['$', '%']);

            $table->unsignedInteger('duration_value');

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
        Schema::dropIfExists('discounts');
    }
}
