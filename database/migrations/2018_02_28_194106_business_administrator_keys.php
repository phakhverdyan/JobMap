<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessAdministratorKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platform = \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::disableForeignKeyConstraints();
        Schema::table('business_administrators', function ($table) {
            $table->integer('business_id')->unsigned()->change();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        
        Schema::table('business_administrators', function ($table) {
            $table->dropForeign('business_administrators_business_id_foreign');
            $table->dropIndex('business_administrators_business_id_foreign');
            $table->dropForeign('business_administrators_user_id_foreign');
            $table->dropIndex('business_administrators_user_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
