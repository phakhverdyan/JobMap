<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('businesses', function (Blueprint $table) {
            $table->boolean('franchaise')->default(false)->nullable();
            $table->boolean('small_business')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('franchaise');
            $table->dropColumn('small_business');
        });
    }
}
