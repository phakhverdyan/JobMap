<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsInBusinessWebsiteWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->string('language_prefix', 2)->after('code');
            $table->string('background_color', 20)->nullable()->after('language_prefix');
            $table->string('link_one_color', 20)->nullable()->after('background_color');
            $table->string('font_color', 20)->nullable()->after('link_one_color');
            $table->string('background_image', 255)->nullable()->after('font_color');
            $table->dropColumn('data');
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
            $table->dropColumn(['background_color', 'link_one_color', 'font_color', 'background_image', 'language_prefix']);
            $table->text('data');
        });
    }
}
