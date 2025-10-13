<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // Untuk membedakan sesi obrolan
            $table->text('user_message');
            $table->text('bot_response');
            $table->string('session_title')->nullable();
            $table->timestamps(); // Menggunakan timestamps default Laravel
            $table->index(['session_id']); // Index untuk optimasi query
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_histories');
    }
}