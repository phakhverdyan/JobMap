<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSocialFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('social');
            $table->dropColumn('social_id');
            $table->dropColumn('social_token');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->string('social_token', 255)->nullable()->after('gender');
            $table->string('social_id', 255)->nullable()->after('gender');
            $table->string('social', 32)->nullable()->after('gender');
        });
    }
}
