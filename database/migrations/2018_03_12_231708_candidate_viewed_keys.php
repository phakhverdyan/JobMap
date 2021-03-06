<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidateViewedKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('candidate_vieweds', function ($table) {
            $table->foreign('manager_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('candidate_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('candidate_vieweds', function ($table) {
            $table->dropForeign('candidate_vieweds_manager_user_id_foreign');
            $table->dropIndex('candidate_vieweds_manager_user_id_foreign');
            
            $table->dropForeign('candidate_vieweds_business_id_foreign');
            $table->dropIndex('candidate_vieweds_business_id_foreign');
            
            $table->dropForeign('candidate_vieweds_candidate_user_id_foreign');
            $table->dropIndex('candidate_vieweds_candidate_user_id_foreign');
            
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
