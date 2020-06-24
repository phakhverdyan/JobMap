<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusMaxPurchaseQuantityToPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_billing_plans', function (Blueprint $table) {
            $table->string('status')->nullable()->default('active')->after('product_id');
            $table->integer('purchase_max_quantity')->default('1')->after('quantity');
            $table->string('color_css')->default('background-color: black;')->after('purchase_max_quantity');
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
        Schema::table('business_billing_plans', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('purchase_max_quantity');
            $table->dropColumn('color_css');
        });
    }
}
