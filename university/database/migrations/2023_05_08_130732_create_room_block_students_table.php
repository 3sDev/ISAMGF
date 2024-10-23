<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBlockStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_block_students', function (Blueprint $table) {
            $table->id();

            $table->string('statut', 20)->nullable();

            $table->unsignedBigInteger('student_blocked_id');
            $table->foreign('student_blocked_id')->references('id')->on('students');

            $table->unsignedBigInteger('student_blocker_id');
            $table->foreign('student_blocker_id')->references('id')->on('students');
            
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
        Schema::dropIfExists('room_block_students');
    }
}
