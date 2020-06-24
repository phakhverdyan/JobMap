<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessSizeKeys extends Migration
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
            $table->integer('size_id')->unsigned()->change();
            $table->foreign('size_id')->references('id')->on('business_sizes');
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
            $table->dropForeign('businesses_size_id_foreign');
            $table->dropIndex('businesses_size_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
