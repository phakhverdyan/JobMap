<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('display_name', 255);
            $table->timestamps();
        });

        // Create table for associating department to admin_users (Many-to-Many)
        Schema::create('admin_user_department', function (Blueprint $table) {
            $table->integer('admin_user_id')->unsigned();
            $table->integer('department_id')->unsigned();

            $table->foreign('admin_user_id')->references('id')->on('admin_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_user_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
