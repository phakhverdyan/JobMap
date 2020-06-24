<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('users', function ($table) {
            $table->integer('language')->unsigned()->change();
            $table->foreign('language')->references('id')->on('languages');
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
        Schema::table('users', function ($table) {
            $table->dropForeign('users_language_foreign');
            $table->dropIndex('users_language_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
