<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->integer('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->string('ddn');
            $table->string('genre');
            $table->string('email');
            $table->integer('phone');
            $table->string('gov');
            $table->string('rue');
            $table->integer('codepostal');
            $table->string('login');
            $table->string('password');
            $table->string('profile_image');

            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes');

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
        Schema::dropIfExists('etudiants');
    }
}
