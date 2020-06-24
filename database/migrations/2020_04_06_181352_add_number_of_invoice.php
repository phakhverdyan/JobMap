<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumberOfInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_billing_invoices', function (Blueprint $table) {
            $table->integer("amount_paid")->nullable();
            $table->integer("amount_remaining")->nullable();
            $table->boolean("attempted")->nullable();
            $table->string("billing_reason")->nullable();
            $table->timestamp("created")->nullable();
            $table->string("description")->nullable();
            $table->string("discount")->nullable();
            $table->timestamp("due_date")->nullable();
            $table->string("hosted_invoice_url")->nullable();
            $table->string("invoice_pdf")->nullable();
            $table->timestamp("next_payment_attempt")->nullable();
            $table->string("number")->nullable();
            $table->string("payment_intent")->nullable();
            $table->string("status")->nullable();
            $table->integer("total")->nullable();
            $table->timestamp("webhooks_delivered_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('business_billing_invoices', function (Blueprint $table) {
            $table->dropColumn("amount_paid");
            $table->dropColumn("amount_remaining");
            $table->dropColumn("attempted");
            $table->dropColumn("billing_reason");
            $table->dropColumn("created");
            $table->dropColumn("description");
            $table->dropColumn("discount");
            $table->dropColumn("due_date");
            $table->dropColumn("hosted_invoice_url");
            $table->dropColumn("invoice_pdf");
            $table->dropColumn("next_payment_attempt");
            $table->dropColumn("number");
            $table->dropColumn("payment_intent");
            $table->dropColumn("status");
            $table->dropColumn("total");
            $table->dropColumn("webhooks_delivered_at");
        });
    }
}
