<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            // $table->dropColumn('last_message');
            // $table->dropColumn('status');
            // $table->integer('last_message_id')->unsigned()->after('user_id');
            $table->dropColumn('message');
            $table->dropColumn('status');
            $table->text('text')->after('user_id');
            $table->string('state')->after('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            // $table->dropColumn('last_message_id');
            // $table->dropColumn('state');
            // $table->text('last_message')->after('user_id');
            // $table->integer('status')->unsigned()->after('last_message');
            $table->dropColumn('text');
            $table->dropColumn('state');
            $table->text('message')->after('user_id');
            $table->integer('status')->unsigned()->after('message');
        });
    }
}
