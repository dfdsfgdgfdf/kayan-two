<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('sender_id');
            $table->char('sender_type');
            $table->bigInteger('receiver_id');
            $table->char('receiver_type');
            $table->char('title');
            $table->text('content');
            $table->boolean('replay')->default(0);
            $table->boolean('read')->default(0);
            $table->boolean('read_status')->default(0);
            $table->bigInteger('old_id')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
