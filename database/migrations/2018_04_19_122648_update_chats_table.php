<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            // $table->dropColumn('last_message_id');
            $table->dropColumn('room');
            // $table->integer('last_message_id')->unsigned()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            // $table->dropColumn('last_message_id');
            // $table->text('last_message')->after('user_id');
            $table->string('room', 64)->after('id');
        });
    }
}
