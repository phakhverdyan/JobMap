<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueFieldsFromUserPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            /*$table->enum('new_job', ['yes', 'no'])->default('no')->change();
            $table->enum('its_urgent', ['yes', 'no'])->default('no')->change();*/
            DB::statement("ALTER TABLE user_preferences CHANGE new_opportunities new_opportunities ENUM('yes', 'no') NOT NULL DEFAULT 'no'");
            DB::statement("ALTER TABLE user_preferences CHANGE its_urgent its_urgent ENUM('yes', 'no') NOT NULL DEFAULT 'no'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            /*$table->enum('new_job', ['yes', 'no'])->default('yes');
            $table->enum('its_urgent', ['yes', 'no'])->default('yes');*/
            DB::statement("ALTER TABLE user_preferences CHANGE new_opportunities new_opportunities ENUM('yes', 'no') NOT NULL DEFAULT 'yes'");
            DB::statement("ALTER TABLE user_preferences CHANGE its_urgent its_urgent ENUM('yes', 'no') NOT NULL DEFAULT 'yes'");
        });
    }
}
