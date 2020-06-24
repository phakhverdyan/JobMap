<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_availabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('full_time')->default(1);
            $table->integer('part_time')->default(1);
            $table->integer('internship')->default(1);
            $table->integer('contractual')->default(1);
            $table->integer('summer_positions')->default(1);
            $table->integer('recruitment')->default(1);
            $table->integer('field_placement')->default(1);
            $table->integer('volunteer')->default(1);
            $table->string('time_1', 16)->nullable();
            $table->string('time_2', 16)->nullable();
            $table->string('time_3', 16)->nullable();
            $table->string('time_4', 16)->nullable();
            $table->integer('is_complete')->default(0);
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
        Schema::dropIfExists('users_availabilities');
    }
}
