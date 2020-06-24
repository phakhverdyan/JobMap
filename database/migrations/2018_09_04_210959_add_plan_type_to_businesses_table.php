<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlanTypeToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            DB::statement('ALTER TABLE `businesses` ADD COLUMN `plan_type` VARCHAR(191) NULL AFTER `zip_code`;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            DB::statement('ALTER TABLE `businesses` DROP COLUMN `plan_type`;');
        });
    }
}
