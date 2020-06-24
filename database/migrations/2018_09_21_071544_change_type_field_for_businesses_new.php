<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeFieldForBusinessesNew extends Migration
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
            $table->enum('type', [
                'private','franchisee','online','hiring','ee',
            ])->default('private')->change();
        });*/

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `businesses` CHANGE `type` `type` ENUM(\'Private Employer\',\'Franchisee\',\'Online Employer\',\'Hiring Firm\',\'Education Establishment\',\'private\',\'franchisee\',\'online\',\'hiring\',\'ee\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'private\';');

        \Illuminate\Support\Facades\DB::statement('UPDATE `businesses` set `type` = \'private\' where `type` = \'Private Employer\';');
        \Illuminate\Support\Facades\DB::statement('UPDATE `businesses` set `type` = \'franchisee\' where `type` = \'Franchisee\';');
        \Illuminate\Support\Facades\DB::statement('UPDATE `businesses` set `type` = \'online\' where `type` = \'Online Employer\';');
        \Illuminate\Support\Facades\DB::statement('UPDATE `businesses` set `type` = \'hiring\' where `type` = \'Hiring Firm\';');
        \Illuminate\Support\Facades\DB::statement('UPDATE `businesses` set `type` = \'ee\' where `type` = \'Education Establishment\';');

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `businesses` CHANGE `type` `type` ENUM(\'private\',\'franchisee\',\'online\',\'hiring\',\'ee\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'private\';');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('businesses', function (Blueprint $table) {
            $table->enum('type', [
                'Private Employer','Franchisee','Online Employer','Hiring Firm','Education Establishment',
            ])->default('Private Employer')->change();
        });*/
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `businesses` CHANGE `type` `type` ENUM(\'Private Employer\',\'Franchisee\',\'Online Employer\',\'Hiring Firm\',\'Education Establishment\') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'Private Employer\';');
    }
}
