<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_country_code', 2)->nullable()->after('mobile_phone');
            $table->string('phone_code')->nullable()->after('phone_country_code');
            $table->string('phone_number')->nullable()->after('phone_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_country_code');
            $table->dropColumn('phone_code');
            $table->dropColumn('phone_number');
        });
    }
}
