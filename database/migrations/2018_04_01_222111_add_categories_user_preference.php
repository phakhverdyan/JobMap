<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesUserPreference extends Migration
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
            $table->string('sub_categories')->default("")->after("sub_industries");
            $table->string('categories')->default("")->after("sub_industries");
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
            $table->dropColumn("sub_categories");
            $table->dropColumn("categories");
        });
    }
}
