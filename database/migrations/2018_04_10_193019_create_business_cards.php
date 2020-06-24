<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->string('owner')->nullable();
            $table->integer('expire_month')->nullable();
            $table->integer('expire_year')->nullable();
            $table->string('card_brand')->nullable();
            $table->integer('card_last_four')->nullable();
            $table->integer('is_default')->default('0');
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
        Schema::dropIfExists('business_cards');
    }
}
