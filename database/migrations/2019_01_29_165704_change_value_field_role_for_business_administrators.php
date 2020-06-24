<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeValueFieldRoleForBusinessAdministrators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_administrators', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE business_administrators CHANGE role role ENUM('admin', 'manager', 'franchisee', 'branch')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_administrators', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE business_administrators CHANGE role role ENUM('admin', 'manager', 'branch', 'franchise')");
        });
    }
}
