<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForMapForBusinessesUnconfirmed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses_unconfirmed', function (Blueprint $table) {
            $table->string('city', 64)->nullable()->after('keyword_id');
            $table->string('region', 255)->nullable()->after('keyword_id');
            $table->string('country', 64)->nullable()->after('keyword_id');
            $table->string('country_code', 2)->nullable()->after('keyword_id');
            $table->string('street', 255)->nullable()->after('keyword_id');
            $table->string('street_number', 16)->nullable()->after('keyword_id');
            $table->string('suite', 16)->nullable()->after('keyword_id');
            $table->decimal('latitude', 10, 8)->default(0)->after('keyword_id');
            $table->decimal('longitude', 10, 8)->default(0)->after('keyword_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses_unconfirmed', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('region');
            $table->dropColumn('country');
            $table->dropColumn('country_code');
            $table->dropColumn('street');
            $table->dropColumn('street_number');
            $table->dropColumn('suite');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
