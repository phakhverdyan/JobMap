<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResumeBuilderFieldsToPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_preferences', function ($table) {
            $table->string('interested_jobs', 16)->nullable()->after('user_id');
            $table->integer('current_job')->default(1)->after('user_id');
            $table->integer('current_type')->default(1)->after('user_id');
            $table->enum('looking_job', ['yes', 'no'])->default('yes')->after('user_id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_preferences', function ($table) {
            $table->dropColumn('looking_job');
            $table->dropColumn('current_type');
            $table->dropColumn('current_job');
            $table->dropColumn('interested_jobs');
        });
    }
}
