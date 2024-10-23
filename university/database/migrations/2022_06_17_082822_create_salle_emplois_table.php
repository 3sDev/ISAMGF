<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalleEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salle_emplois', function (Blueprint $table) {
            $table->id();

            $table->string('statut', 20);
            $table->string('jour', 20);
            $table->string('heure', 20);
            $table->string('seance', 20);
            
            $table->unsignedBigInteger('salle_id');
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('salle_emplois');
    }
}
