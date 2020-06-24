<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_administrators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->integer('user_id');
            $table->string('phone_country_code', 16)->nullable();
            $table->string('phone_code', 16)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('email_notification', 255)->nullable();
            $table->integer('notification_new_candidates')->default(1);
            $table->integer('notification_new_messages')->default(1);
            $table->integer('notification_new_follower')->default(1);
            $table->enum('role', [
                'admin',
                'manager',
                'branch'
            ]);
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
        Schema::dropIfExists('businesses_administrators');
    }
}
