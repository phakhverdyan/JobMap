<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidateResumeRequestKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('candidate_resume_requests', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('candidate_resume_requests', function ($table) {
            $table->dropForeign('candidate_resume_requests_user_id_foreign');
            $table->dropIndex('candidate_resume_requests_user_id_foreign');
            
            $table->dropForeign('candidate_resume_requests_business_id_foreign');
            $table->dropIndex('candidate_resume_requests_business_id_foreign');
            
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
