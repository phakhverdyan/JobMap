<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeKeyToBusinessJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_jobs', function (Blueprint $table) {
            $table->string('type_key')->nullable()->after('salary_type');
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
            $table->dropColumn('type_key');
        });
    }
}
