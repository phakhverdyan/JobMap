<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefundTypeToBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function ($table) {
            DB::statement("ALTER TABLE billings CHANGE status status ENUM('paid', 'unpaid', 'refund')");
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
            DB::statement("ALTER TABLE billings CHANGE status status ENUM('paid', 'unpaid')");
        });
    }
}
