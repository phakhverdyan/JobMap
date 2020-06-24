<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValuesUserPreferences extends Migration
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
        
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->integer('hours_from')->default(5)->change();
            $table->integer('hours_to')->default(35)->change();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $platform = \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->integer('hours_from')->nullable()->change();
            $table->integer('hours_to')->nullable()->change();
        });
    }
}
