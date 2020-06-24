<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeVersionCandidatesToPricingStrategyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricing_strategy', function (Blueprint $table) {
            $table->integer('free_version_candidates')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricing_strategy', function (Blueprint $table) {
            $table->dropColumn('free_version_candidates');
        });
    }
}
