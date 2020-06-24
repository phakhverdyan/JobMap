<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForCandidateNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_notes', function (Blueprint $table) {
            $table->string('attach_file')->nullable()->after('message');
            $table->integer('rating')->unsigned()->default(1)->after('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_notes', function (Blueprint $table) {
            $table->dropColumn('attach_file');
            $table->dropColumn('rating');
        });
    }
}
