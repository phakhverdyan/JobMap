<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialVideoFieldsForBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('snapchat_fr')->nullable()->after('twitter_fr');
            $table->string('snapchat')->nullable()->after('twitter_fr');
            $table->string('youtube_fr')->nullable()->after('twitter_fr');
            $table->string('youtube')->nullable()->after('twitter_fr');
            $table->string('video')->nullable();
            $table->string('video_fr')->nullable();
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
            $table->dropColumn('snapchat');
            $table->dropColumn('snapchat_fr');
            $table->dropColumn('youtube');
            $table->dropColumn('youtube_fr');
            $table->dropColumn('video');
            $table->dropColumn('video_fr');
        });
    }
}
