<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessJobCertificatesKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_job_certificates', function ($table) {
            $table->integer('job_id')->unsigned()->change();
            $table->foreign('job_id')->references('id')->on('business_jobs')->onDelete('cascade');
            $table->integer('certificate_id')->unsigned()->change();
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
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
        Schema::table('business_job_certificates', function ($table) {
            $table->dropForeign('business_job_certificates_job_id_foreign');
            $table->dropIndex('business_job_certificates_job_id_foreign');
            $table->dropForeign('business_job_certificates_certificate_id_foreign');
            $table->dropIndex('business_job_certificates_certificate_id_foreign');
        });
        Schema::table('business_job_certificates', function (BluePrint $table) {
            $table->integer('certificate_id')->change();
            $table->integer('job_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
