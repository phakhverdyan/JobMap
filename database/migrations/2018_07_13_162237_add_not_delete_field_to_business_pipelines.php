<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotDeleteFieldToBusinessPipelines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_pipelines', function (Blueprint $table) {
            $table->boolean('not_delete')->default('0')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_pipelines', function (Blueprint $table) {
            $table->dropColumn('not_delete');
        });
    }
}
