<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employers')->default(0);
            $table->integer('jobs_assign_open')->default(0);
            $table->integer('jobs_assign_close')->default(0);
            $table->integer('jobs_open')->default(0);
            $table->integer('jobs_close')->default(0);
            $table->integer('headquarters')->default(0);
            $table->integer('locations')->default(0);
            $table->integer('keywords')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
