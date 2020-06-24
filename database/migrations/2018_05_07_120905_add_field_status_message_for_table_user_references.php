<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldStatusMessageForTableUserReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_references', function (Blueprint $table) {
            $table->string('status')->default('requested')->after('company');
            $table->string('message')->nullable()->after('company');
            $table->text('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_references', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('message');
            $table->dropColumn('remember_token');
        });
    }
}
