<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_students', function (Blueprint $table) {
            $table->id();
            $table->string('message', 455);
            $table->string('vue');
            $table->integer('archive');

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('student_id_sender');
            $table->foreign('student_id_sender')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('student_id_receiver');
            $table->foreign('student_id_receiver')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('room_students');
    }
}
