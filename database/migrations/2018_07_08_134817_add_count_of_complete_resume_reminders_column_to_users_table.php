<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountOfCompleteResumeRemindersColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('count_of_complete_resume_reminders')->unsigned()->after('resume_is_completed');
            $table->dateTime('last_complete_resume_reminder_sent_at')->after('count_of_complete_resume_reminders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('count_of_complete_resume_reminders');
            $table->dropColumn('last_complete_resume_reminder_sent_at');
        });
    }
}
