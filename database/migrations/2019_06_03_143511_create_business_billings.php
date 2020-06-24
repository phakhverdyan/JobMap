<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxe_id')->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_paid_id')->nullable();
            $table->integer('is_paid')->default('0');
            $table->integer('subscription_start')->default('0');
            $table->integer('subscription_end')->default('0');
            $table->integer('is_subscription')->default('0');
            $table->string('subscription_id')->nullable();
            $table->string('billing_type')->nullable();
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
        Schema::dropIfExists('business_billings');
    }
}

