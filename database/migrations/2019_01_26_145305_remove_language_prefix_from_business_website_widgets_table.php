<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLanguagePrefixFromBusinessWebsiteWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->dropColumn('language_prefix');
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
            $table->string('language_prefix', 2)->after('code');
        });
    }
}
