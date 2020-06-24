<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialFrColumnsToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('facebook_fr')->nullable()->after('facebook');
            $table->string('instagram_fr')->nullable()->after('instagram');
            $table->string('linkedin_fr')->nullable()->after('linkedin');
            $table->string('twitter_fr')->nullable()->after('twitter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('facebook_fr');
            $table->dropColumn('instagram_fr');
            $table->dropColumn('linkedin_fr');
            $table->dropColumn('twitter_fr');
        });
    }
}
