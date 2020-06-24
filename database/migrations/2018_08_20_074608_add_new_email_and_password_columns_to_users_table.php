<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewEmailAndPasswordColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('new_email')->nullable()->after('verification_reminder_sent');
            $table->string('new_email_confirmation_code')->nullable()->after('new_email');
            $table->string('new_password')->nullable()->after('new_email_confirmation_code');
            $table->string('new_password_confirmation_code')->nullable()->after('new_password');
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
            $table->dropColumn('new_email');
            $table->dropColumn('new_email_confirmation_code');
            $table->dropColumn('new_password');
            $table->dropColumn('new_password_confirmation_code');
        });
    }
}
