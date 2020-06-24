<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailFieldToRequestCallbacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_callbacks', function (Blueprint $table) {
            $table->string('email')->nullable()->after('id');
            $table->string('contact_name')->nullable()->change();
            $table->string('employer_name')->nullable()->change();
            $table->integer('employer_number')->nullable()->change();
            $table->integer('location_number')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('extension')->nullable()->change();
            $table->longText('message')->nullable()->change();
            $table->string('time')->nullable()->change();
            $table->string('country')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_callbacks', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
