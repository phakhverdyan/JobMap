<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowJobPostedDateToBusinessWebsiteWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->integer('show_job_posted_date')->default(1)->after('size_widget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->dropColumn('show_job_posted_date');
        });
    }
}
