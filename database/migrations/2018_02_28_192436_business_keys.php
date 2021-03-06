<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessKeys extends Migration
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
            $table->integer('industry_id')->unsigned()->change();
            $table->foreign('industry_id')->references('id')->on('industries');
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
            $table->dropForeign('businesses_industry_id_foreign');
            $table->dropIndex('businesses_industry_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
