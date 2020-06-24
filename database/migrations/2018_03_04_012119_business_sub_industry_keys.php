<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessSubIndustryKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('businesses', function ($table) {
            $table->integer('sub_industry_id')->unsigned()->change();
            $table->foreign('sub_industry_id')->references('id')->on('industries');
        });
        Schema::enableForeignKeyConstraints();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('businesses', function ($table) {
            $table->dropForeign('businesses_sub_industry_id_foreign');
            $table->dropIndex('businesses_sub_industry_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
