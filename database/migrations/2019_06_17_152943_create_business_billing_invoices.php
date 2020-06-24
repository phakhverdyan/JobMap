<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBillingInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_billing_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->integer('taxe_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_paid_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->integer('period_start')->nullable();
            $table->integer('period_end')->nullable();
            $table->integer('paid')->default('0');
            $table->integer('amount_due')->default('0');
            $table->integer('subtotal')->default('0');
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
        Schema::dropIfExists('business_billing_invoices');
    }
}
