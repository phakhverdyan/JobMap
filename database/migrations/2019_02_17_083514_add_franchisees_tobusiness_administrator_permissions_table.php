<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFranchiseesTobusinessAdministratorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_administrator_permissions', function (Blueprint $table) {
            $table->integer('franchisees')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_administrator_permissions', function (Blueprint $table) {
            $table->dropColumn('franchisees');
        });
    }
}
