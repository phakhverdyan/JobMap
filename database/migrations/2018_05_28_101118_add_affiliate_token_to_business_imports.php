<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAffiliateTokenToBusinessImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_imports', function ($table) {
            $table->string('affiliate_token')->after('email');
            $table->integer('send_count')->default(0)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_imports', function (Blueprint $table) {
            $table->dropColumn('affiliate_token');
            $table->dropColumn('send_count');
        });
    }
}
