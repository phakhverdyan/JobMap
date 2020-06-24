<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignKeyForBusinessesUnconfirmed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses_unconfirmed', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('businesses_unconfirmed_keyword_id_foreign');
            $table->dropIndex('businesses_unconfirmed_keyword_id_foreign');
            $table->foreign('keyword_id')->references('id')->on('business_unconfirmed_keywords')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses_unconfirmed', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('businesses_unconfirmed_keyword_id_foreign');
            $table->dropIndex('businesses_unconfirmed_keyword_id_foreign');
            $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
