<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MidifyAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->text('html_signature')->nullable()->after('password');
            $table->string('last_name')->nullable()->after('name');
            $table->string('first_name')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->dropColumn(['html_signature', 'first_name', 'last_name']);
        });
    }
}
