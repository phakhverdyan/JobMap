<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdsFieldsForUserEducations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_educations', function (Blueprint $table) {
            $table->integer('grade_id')->nullable()->after('grade');
            $table->integer('degree_id')->nullable()->after('degree');
            $table->integer('study_id')->nullable()->after('study');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_educations', function (Blueprint $table) {
            $table->dropColumn('study_id');
            $table->dropColumn('degree_id');
            $table->dropColumn('grade_id');
        });
    }
}
