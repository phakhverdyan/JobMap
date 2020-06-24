<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMonthlyPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_plans', function (Blueprint $table) {
            $table->string('plan_id')->after('plan_name');
            $table->string('plan_product')->after('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_plans', function (Blueprint $table) {
            $table->dropColumn(['plan_id', 'plan_product']);
        });
    }
}
