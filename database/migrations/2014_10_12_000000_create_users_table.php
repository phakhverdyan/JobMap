<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date')->nullable();
            $table->string('city', 64)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('gender', 16)->nullable();
            $table->string('social', 32)->nullable();
            $table->string('social_id', 255)->nullable();
            $table->string('social_token', 255)->nullable();
            $table->string('user_pic', 255)->nullable();
            $table->string('user_pic_original', 255)->nullable();
            $table->integer('user_pic_custom')->default(0);
            $table->string('user_pic_filter', 32)->default("");
            $table->integer('last_active_business')->default(0);
            $table->integer('language')->default(1);
            $table->string('invite_token', 255)->nullable();
            $table->integer('invite_business_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
