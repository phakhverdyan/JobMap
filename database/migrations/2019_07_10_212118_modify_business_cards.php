<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBusinessCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_cards', function (Blueprint $table) {
            $table->dropColumn('owner');
            $table->integer('user_id')->nullable()->after('business_id');
            $table->renameColumn('expire_month', 'exp_month');
            $table->renameColumn('expire_year', 'exp_year');
            $table->renameColumn('card_brand', 'brand');
            $table->renameColumn('card_last_four', 'last4');
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
            $table->dropColumn('user_id');
            $table->string('owner')->nullable()->after('business_id');
            $table->renameColumn('exp_month', 'expire_month');
            $table->renameColumn('exp_year', 'expire_year');
            $table->renameColumn('brand', 'card_brand');
            $table->renameColumn('last4', 'card_last_four');
        });
    }
}
