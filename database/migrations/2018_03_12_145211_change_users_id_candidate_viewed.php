<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersIdCandidateViewed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_vieweds', function (Blueprint $table) {
            $table->dropColumn('candidate_id');
            $table->dropColumn('user_id');
            $table->integer('manager_user_id')->unsigned()->after('id');
            $table->integer('candidate_user_id')->unsigned()->after('id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_vieweds', function (Blueprint $table) {
            $table->dropColumn('candidate_user_id');
            $table->dropColumn('manager_user_id');
            $table->integer('user_id')->unsigned()->after('id');
            $table->integer('candidate_id')->unsigned()->after('id');
        });
    }
}
