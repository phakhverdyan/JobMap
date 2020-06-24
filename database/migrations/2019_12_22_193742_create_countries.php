<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('alpha2_code', 2);
            $table->string('alpha3_code', 3);
            $table->string('calling_codes');
            $table->unsignedSmallInteger('phone_code')->nullable();
            $table->string('phone_number_mask')->nullable();
            $table->string('top_level_domains');
            $table->string('capital')->nullable();
            $table->string('alt_spellings');
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->unsignedInteger('population');
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->string('demonym')->nullable();
            $table->unsignedInteger('area')->nullable();
            $table->float('gini', 9, 2)->nullable();
            $table->string('timezones');
            $table->string('borders');
            $table->string('native_name')->nullable();
            $table->string('numeric_code')->nullable();
            $table->string('currencies');
            $table->string('languages');
            $table->string('cioc', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
