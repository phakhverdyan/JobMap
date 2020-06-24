<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('new_job', ['yes', 'no'])->default('yes');
            $table->enum('new_opportunities', ['yes', 'no'])->default('yes');
            $table->integer('distance')->default(0);
            $table->enum('distance_type', ['km', 'miles'])->default('miles');
            $table->integer('industries')->nullable();
            $table->string('salary', 16)->nullable();
            $table->integer('hours_from')->nullable();
            $table->integer('hours_to')->nullable();
            $table->integer('is_complete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_preferences');
    }
}
