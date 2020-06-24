<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldRoleEnumFromBusinessAdministrators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_administrators', function (Blueprint $table) {
            //$table->enum('role', ['admin', 'manager', 'branch', 'franchise'])->change();
            DB::statement("ALTER TABLE business_administrators CHANGE role role ENUM('admin', 'manager', 'branch', 'franchise')");
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
            //$table->enum('role', ['admin', 'manager', 'branch'])->change();
            DB::statement("ALTER TABLE business_administrators CHANGE role role ENUM('admin', 'manager', 'branch')");
        });
    }
}
