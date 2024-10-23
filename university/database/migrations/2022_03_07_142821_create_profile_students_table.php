<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_students', function (Blueprint $table) {
            $table->id();
            $table->string('ddn');
            $table->string('genre');
            $table->integer('phone');
            $table->string('gov')->nullable();
            $table->string('rue')->nullable();
            $table->integer('codepostal')->nullable();
            $table->string('profile_image')->nullable();

            $table->unsignedBigInteger('student_id')->unique();
            $table->foreign('student_id')->references('id')->on('students');

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
        Schema::dropIfExists('profile_students');
    }
}
