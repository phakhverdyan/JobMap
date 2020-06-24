<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsNoForUserPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->integer('not_education')->nullable()->after('first_job');
            $table->integer('not_certification')->nullable()->after('first_job');
            $table->integer('not_distinction')->nullable()->after('first_job');
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
            $table->dropColumn('not_education');
            $table->dropColumn('not_certification');
            $table->dropColumn('not_distinction');
        });
    }
}
