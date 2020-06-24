<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigMacIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_mac_indexes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flag', 255)->nullable();
            $table->string('country_code', 255)->nullable();
            $table->string('country_name', 255);
            $table->decimal('coefficient');
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
        Schema::dropIfExists('big_mac_indexes');
    }
}
