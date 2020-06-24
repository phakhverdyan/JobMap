<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnShowBackgroundImageForBusinessWebsiteWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->boolean('show_background_image')->default(true)->after('code')->after('background_image');
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
            $table->dropColumn('show_background_image');
        });
    }
}
