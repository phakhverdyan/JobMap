<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeFieldForBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('businesses', function (Blueprint $table) {
            //
        });*/
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `businesses` CHANGE `type` `type` ENUM(\'Private Employer\',\'Franchisee\',\'Online Employer\',\'Hiring Firm\',\'Education Establishment\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'Private Employer\';');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('businesses', function (Blueprint $table) {
            //
        });*/
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `businesses` CHANGE `type` `type` ENUM(\'private\',\'franchisee\',\'online\',\'hiring\',\'ee\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'private\';');
    }
}
