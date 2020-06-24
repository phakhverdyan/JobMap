<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessAdministratorsPermissionKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('business_administrator_permissions', function ($table) {
            $table->integer('administrator_id')->unsigned()->change();
            $table->foreign('administrator_id')->references('id')->on('business_administrators')->onDelete('cascade');
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
        Schema::table('business_administrator_permissions', function ($table) {
            $table->dropForeign('business_administrator_permissions_administrator_id_foreign');
            $table->dropIndex('business_administrator_permissions_administrator_id_foreign');
        });
        Schema::table('business_administrator_permissions', function (BluePrint $table) {
            $table->integer('administrator_id')->change();
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
