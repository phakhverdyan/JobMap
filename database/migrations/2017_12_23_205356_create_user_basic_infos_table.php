<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_basic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('headline');
            $table->string('street', 255)->default("");
            $table->string('city', 64)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('mobile_phone', 16)->nullable();
            $table->string('country_phone', 16)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('about');
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
        Schema::dropIfExists('users_basic_infos');
    }
}
