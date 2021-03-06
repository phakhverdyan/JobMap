<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountOfSentEmailRemindersToBusinessImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_imports', function (Blueprint $table) {
            $table->integer('count_of_sent_email_reminders')->unsigned()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_imports', function (Blueprint $table) {
            $table->dropColumn('count_of_sent_email_reminders');
        });
    }
}
