<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxRateIdsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('taxes', function (Blueprint $table) {
            $table->string("tax_rate_1_id")->nullable();
            $table->string("tax_rate_2_id")->nullable();
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
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropColumn("tax_rate_1_id");
            $table->dropColumn("tax_rate_2_id");
        });
    }
}
