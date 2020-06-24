<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('package_id');
            $table->string('owner_name')->nullable()->after('company_name');
            $table->string('street_number')->nullable()->after('owner_name');
            $table->string('street')->nullable()->after('street_number');
            $table->string('suite')->nullable()->after('street');
            $table->string('region')->nullable()->after('suite');
            $table->string('city')->nullable()->after('region');
            $table->string('zip_code')->nullable()->after('city');
            $table->string('country')->nullable()->after('zip_code');
            $table->string('card_id')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('owner_name');
            $table->dropColumn('street_number');
            $table->dropColumn('street');
            $table->dropColumn('suite');
            $table->dropColumn('region');
            $table->dropColumn('city');
            $table->dropColumn('zip_code');
            $table->dropColumn('country');
            $table->dropColumn('card_id');
        });
    }
}
