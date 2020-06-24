<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobFieldsBusinessJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_jobs', function (Blueprint $table) {
            $table->string('options',16)->nullable()->after('time_4');
            $table->string('work_status',16)->nullable()->after('time_4');
            $table->string('career_status',16)->nullable()->after('time_4');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_jobs', function (Blueprint $table) {
            $table->dropColumn('options');
            $table->dropColumn('work_status');
            $table->dropColumn('career_status');
        });
    }
}
