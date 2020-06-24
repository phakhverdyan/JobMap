<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultilanguageFieldsToUserBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic_infos', function (Blueprint $table) {
            $table->string('headline_fr')->after('headline');
            $table->string('about_fr')->after('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_basic_infos', function (Blueprint $table) {
            $table->dropColumn('headline_fr');
            $table->dropColumn('about_fr');
        });
    }
}
