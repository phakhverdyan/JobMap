<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIntervalAndActiveToBillings extends Migration
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
            $table->string('interval')->nullable()->after("subscription_id");
            $table->string('status')->nullable()->after("interval");
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
            $table->dropColumn('interval');
            $table->dropColumn('status');
        });
    }
}
