<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatroomUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatroom_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatroom_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->nullable();
            $table->string('status')->default(\App\Constant\ChatroomUserStatus::ACCEPTED)->comment('accepted/pending/denied');
            $table->dateTime('view_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatroom_users');
    }
}
