<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNexusInitialTaxConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nexus_initial_tax_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gst_number', 255);
            $table->string('qst_number', 255);
            $table->string('qc_company_number', 255);
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
        Schema::dropIfExists('nexus_initial_tax_config');
    }
}
