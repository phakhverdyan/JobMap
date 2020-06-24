<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title', 255);
            $table->string('company', 255);
            $table->string('city', 64);
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('current')->default(0);
            $table->integer('industry')->default(0);
            $table->text('description');
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
        Schema::dropIfExists('users_experiences');
    }
}
