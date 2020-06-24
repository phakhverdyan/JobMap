<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBusinessIdFieldForHowToStartGotIts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('how_to_start_got_its', function (Blueprint $table) {
            $table->integer('business_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('how_to_start_got_its', function (Blueprint $table) {
            $table->integer('business_id')->change();
        });
    }
}
