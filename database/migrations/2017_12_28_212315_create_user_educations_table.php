<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('school_name', 255);
            $table->string('city', 64);
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->year('year_from');
            $table->year('year_to');
            $table->string('grade', 16)->nullable();
            $table->integer('current')->default(0);
            $table->string('degree', 255)->nullable();
            $table->string('study', 255)->nullable();
            $table->text('activities')->nullable();
            $table->text('description')->nullable();
            $table->string('achievement_title', 255)->nullable();
            $table->text('achievement_description')->nullable();
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
        Schema::dropIfExists('users_educations');
    }
}
