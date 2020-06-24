<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionFieldsToInterviewRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_requests', function (Blueprint $table) {
            $table->string('internal_description')->after('date');
            $table->string('external_description')->after('internal_description');
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
            $table->dropColumn('internal_description');
            $table->dropColumn('external_description');
        });
    }
}
