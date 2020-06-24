<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnFieldsForBusinessAdministratorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_administrator_permissions', function (Blueprint $table) {
            $table->integer('add_new_seat')->default(0)->after('administrator_id');
            $table->integer('demote_promote')->default(0)->after('administrator_id');
            $table->integer('view_candidates_own')->default(0)->after('view_candidates');
            $table->integer('candidates_own')->default(0)->after('candidates');
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
            $table->dropColumn('demote_promote');
            $table->dropColumn('add_new_seat');
            $table->dropColumn('view_candidates_own');
            $table->dropColumn('candidates_own');
        });
    }
}
