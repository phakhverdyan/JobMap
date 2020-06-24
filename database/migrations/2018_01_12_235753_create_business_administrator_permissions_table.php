<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAdministratorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_administrator_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('administrator_id');
            $table->integer('jobs')->default(1);
            $table->integer('locations')->default(1);
            $table->integer('business')->default(1);
            $table->integer('managers')->default(1);
            $table->integer('share')->default(1);
            $table->integer('contact_candidates')->default(1);
            $table->integer('contact_employees')->default(1);
            $table->integer('view_candidates')->default(1);
            $table->integer('candidates')->default(1);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_administrator_permissions');
    }
}
