<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeNewFieldToBusinessPipelines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_pipelines', function (Blueprint $table) {
            $table->enum('type_new', [
                'import', 'interested', 'viewed', 'contacted', 'to_iterview', 'employees', 'archived', 'custom'
            ])->default('custom')->after('type');
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
            $table->dropColumn('type_new');
        });
    }
}
