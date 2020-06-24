<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlanIdAndCountToBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_billings', function (Blueprint $table) {
            $table->integer('plan_id')->nullable()->after("subscription_id");
            $table->integer('pack_id')->nullable()->after("plan_id");
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
        Schema::table('business_billings', function (Blueprint $table) {
            $table->dropColumn('plan_id');
            $table->dropColumn('pack_id');
        });
    }
}
