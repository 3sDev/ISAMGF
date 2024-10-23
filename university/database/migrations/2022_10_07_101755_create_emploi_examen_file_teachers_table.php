<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploiExamenFileTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploi_examen_file_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('annee_universitaire', 20);
            $table->integer('semestre');
            $table->string('type', 10);
            $table->string('session', 50)->nullable();
            $table->string('description')->nullable();
            $table->string('fichier', 20);

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('emploi_examen_file_teachers');
    }
}
