<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLanguageAddLanguagePrefixColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_language_foreign');
            $table->dropIndex('users_language_foreign');
            $table->string('language_prefix')->after('language');
            $table->dropColumn('language');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            $table->integer('language')->unsigned()->after('language_prefix');
            $table->foreign('language')->references('id')->on('languages');
            $table->dropColumn('language_prefix');
        });

        Schema::enableForeignKeyConstraints();
    }
}
