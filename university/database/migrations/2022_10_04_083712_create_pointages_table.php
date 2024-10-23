<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointages', function (Blueprint $table) {
            $table->id();
            $table->string('lat', 20);
            $table->string('lng', 20);
            $table->string('nom_matiere', 100);
            $table->string('jour', 10);
            $table->string('salle', 30);
            $table->string('heure_debut', 20);
            $table->string('heure_fin', 20);
            $table->string('description', 255)->nullable();

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('seance_id');
            $table->foreign('seance_id')->references('id')->on('emploi_teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pointages');
    }
}
