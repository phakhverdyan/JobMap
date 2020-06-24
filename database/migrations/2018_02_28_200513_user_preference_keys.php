<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPreferenceKeys extends Migration
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
        Schema::table('user_preferences', function ($table) {
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
        Schema::table('user_preferences', function ($table) {
            $table->dropForeign('user_preferences_user_id_foreign');
            $table->dropIndex('user_preferences_user_id_foreign');
        });
        
        Schema::enableForeignKeyConstraints();
    }
}
