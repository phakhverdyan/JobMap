<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValuesUserAvailabilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_availabilities', function (Blueprint $table) {
            $table->integer('full_time')->default(0)->change();
            $table->integer('part_time')->default(0)->change();
            $table->integer('internship')->default(0)->change();
            $table->integer('contractual')->default(0)->change();
            $table->integer('summer_positions')->default(0)->change();
            $table->integer('recruitment')->default(0)->change();
            $table->integer('field_placement')->default(0)->change();
            $table->integer('volunteer')->default(0)->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_availabilities', function (Blueprint $table) {
            $table->integer('full_time')->default(1)->change();
            $table->integer('part_time')->default(1)->change();
            $table->integer('internship')->default(1)->change();
            $table->integer('contractual')->default(1)->change();
            $table->integer('summer_positions')->default(1)->change();
            $table->integer('recruitment')->default(1)->change();
            $table->integer('field_placement')->default(1)->change();
            $table->integer('volunteer')->default(1)->change();
        });
    }
}
