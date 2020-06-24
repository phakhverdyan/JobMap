<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn(['off_an_locations_value', 'off_an_locations_type','off_on_seats_value','off_on_seats_type']);
            $table->unsignedInteger('off_an_plans_value')->after('code');
            $table->enum('off_an_plans_type', ['$', '%'])->after('off_an_plans_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn(['off_an_plans_type', 'off_an_plans_value']);

            $table->unsignedInteger('off_an_locations_value')->after('code');
            $table->enum('off_an_locations_type', ['$', '%'])->after('off_an_locations_value');

            $table->unsignedInteger('off_on_seats_value')->after('off_an_locations_type');
            $table->enum('off_on_seats_type', ['$', '%'])->after('off_on_seats_value');


        });
    }
}
