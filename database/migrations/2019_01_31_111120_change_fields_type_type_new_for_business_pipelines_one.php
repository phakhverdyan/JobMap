<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsTypeTypeNewForBusinessPipelinesOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_pipelines', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE business_pipelines CHANGE type_new type_new ENUM('invited', 'new', 'contacted', 'hired', 'rejected', 'custom')");
            DB::statement("ALTER TABLE business_pipelines CHANGE type type ENUM('ats', 'new', 'contacted', 'hired', 'rejected', 'custom')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_pipelines', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE business_pipelines CHANGE type_new type_new ENUM('import', 'interested', 'viewed', 'contacted', 'to_iterview', 'employees', 'archived', 'custom')");
            DB::statement("ALTER TABLE business_pipelines CHANGE type type ENUM('ats', 'new', 'viewed', 'employees', 'custom')");
        });
    }
}
