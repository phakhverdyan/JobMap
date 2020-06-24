<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function ($table) {
            $table->string('phone', 16)->nullable()->after('suite');
            $table->string('phone_code', 16)->nullable()->after('suite');
            $table->string('phone_country_code', 16)->nullable()->after('suite');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function ($table) {
            $table->dropColumn('phone_country_code');
            $table->dropColumn('phone_code');
            $table->dropColumn('phone');
        });
    }
}