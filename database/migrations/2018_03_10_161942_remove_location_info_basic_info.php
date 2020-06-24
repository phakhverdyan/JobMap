<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLocationInfoBasicInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic_infos', function ($table) {
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('region');
            $table->dropColumn('country');
            $table->dropColumn('country_code');
            $table->dropColumn('mobile_phone');
            $table->dropColumn('country_phone');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_basic_infos', function ($table) {
            $table->string('country_phone', 16)->nullable()->after('headline');
            $table->string('mobile_phone', 16)->nullable()->after('headline');
            $table->string('country_code', 2)->nullable()->after('headline');
            $table->string('country', 64)->nullable()->after('headline');
            $table->string('region', 255)->nullable()->after('headline');
            $table->string('city', 64)->nullable()->after('headline');
            $table->string('street', 255)->default("")->after('headline');
        });
    }
}
