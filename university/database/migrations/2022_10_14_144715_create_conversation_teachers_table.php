<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('message', 455);
            $table->string('vue');
            $table->integer('archive');

            $table->unsignedBigInteger('conversation_id');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('teacher_id_sender');
            $table->foreign('teacher_id_sender')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('teacher_id_receiver');
            $table->foreign('teacher_id_receiver')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('conversation_teachers');
    }
}
