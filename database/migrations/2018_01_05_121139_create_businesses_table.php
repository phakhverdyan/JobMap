<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('description');
            $table->integer('industry_id');
            $table->string('website', 255)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('street', 255);
            $table->string('picture', 255)->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
