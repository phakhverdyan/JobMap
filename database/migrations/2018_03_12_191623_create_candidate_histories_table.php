<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manager_user_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->integer('candidate_user_id')->unsigned();
            $table->string('pipeline');
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
        Schema::dropIfExists('candidate_histories');
    }
}
