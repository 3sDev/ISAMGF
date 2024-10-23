<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('ddn');
            $table->string('genre');
            $table->integer('phone');
            $table->string('gov')->nullable();
            $table->string('rue')->nullable();
            $table->integer('codepostal')->nullable();
            $table->string('profile_image')->nullable();

            $table->unsignedBigInteger('teacher_id')->unique();
            $table->foreign('teacher_id')->references('id')->on('teachers');

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
        Schema::dropIfExists('profile_teachers');
    }
}
