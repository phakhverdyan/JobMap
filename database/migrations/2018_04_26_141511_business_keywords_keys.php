<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessKeywordsKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_keywords', function ($table) {
            $table->integer('business_id')->unsigned()->change();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->integer('keyword_id')->unsigned()->change();
            $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
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
        Schema::table('business_keywords', function ($table) {
            $table->dropForeign('business_keywords_business_id_foreign');
            $table->dropIndex('business_keywords_business_id_foreign');
            $table->dropForeign('business_keywords_keyword_id_foreign');
            $table->dropIndex('business_keywords_keyword_id_foreign');
        });
        Schema::table('business_keywords', function (BluePrint $table) {
            $table->integer('keyword_id')->change();
            $table->integer('business_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
