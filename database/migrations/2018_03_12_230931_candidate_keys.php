<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidateKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('candidates', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('business_locations')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
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
        Schema::table('candidates', function ($table) {
            $table->dropForeign('candidates_user_id_foreign');
            $table->dropIndex('candidates_user_id_foreign');
    
            $table->dropForeign('candidates_business_id_foreign');
            $table->dropIndex('candidates_business_id_foreign');
    
            $table->dropForeign('candidates_location_id_foreign');
            $table->dropIndex('candidates_location_id_foreign');
    
            $table->dropForeign('candidates_job_id_foreign');
            $table->dropIndex('candidates_job_id_foreign');
            
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
