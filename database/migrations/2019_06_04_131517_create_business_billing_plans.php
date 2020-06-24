<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBillingPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_billing_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('name')->nullable();
            $table->double('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('interval_name')->nullable();
            $table->string('descriptor')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('business_billing_plans');
    }
}

