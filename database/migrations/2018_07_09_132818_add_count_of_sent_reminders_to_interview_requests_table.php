<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountOfSentRemindersToInterviewRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_requests', function (Blueprint $table) {
            $table->integer('count_of_sent_reminders')->unsigned()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_requests', function (Blueprint $table) {
            $table->dropColumn('count_of_sent_reminders');
        });
    }
}
