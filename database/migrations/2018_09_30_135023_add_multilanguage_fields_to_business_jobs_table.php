<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultilanguageFieldsToBusinessJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_jobs', function(Blueprint $table) {
            $table->text('description_fr')->after('description');
            $table->text('notes_fr')->after('notes');
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
            $table->dropColumn('description_fr');
            $table->dropColumn('notes_fr');
        });
    }
}
