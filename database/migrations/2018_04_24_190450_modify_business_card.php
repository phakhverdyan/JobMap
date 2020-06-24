<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBusinessCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->string('fingerprint')->after('is_default');
            $table->string('card_id')->after('fingerprint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn('fingerprint');
            $table->dropColumn('card_id');
        });
    }
}
