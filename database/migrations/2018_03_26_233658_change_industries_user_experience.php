<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIndustriesUserExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_experiences', function (Blueprint $table) {
            $table->dropColumn('industry');
            $table->integer('sub_industry_id')->nullable()->unsigned()->after('current');
            $table->integer('industry_id')->nullable()->unsigned()->after('current');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_experiences', function (Blueprint $table) {
            $table->integer('industry')->default(0)->after('current');
            $table->dropColumn('sub_industry_id');
            $table->dropColumn('industry_id');
        });
    }
}
