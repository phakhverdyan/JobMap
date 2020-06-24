<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('user_id');
            $table->string('title', 255);
            $table->string('salary', 16);
            $table->char('salary_type', 1);
            $table->integer('hours');
            $table->string('time_1', 16)->nullable();
            $table->string('time_2', 16)->nullable();
            $table->string('time_3', 16)->nullable();
            $table->string('time_4', 16)->nullable();
            $table->text('description');
            $table->text('notes');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('business_jobs');
    }
}
