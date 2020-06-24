<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeWidgetToBusinessWebsiteWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_website_widgets', function (Blueprint $table) {
            $table->string('size_widget')->default("small")->after('button_text_color');
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
            $table->dropColumn('size_widget');
        });
    }
}
