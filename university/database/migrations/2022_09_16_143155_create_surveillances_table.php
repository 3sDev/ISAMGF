<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveillancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveillances', function (Blueprint $table) {
            $table->id();
            $table->string('annee_universitaire', 20);
            $table->integer('semestre');
            $table->string('fichier', 20)->nullable();
            $table->string('type', 20);
            $table->string('session', 10)->nullable();
            $table->string('jour_1', 20)->nullable();
            $table->string('jour_2', 20)->nullable();
            $table->string('jour_3', 20)->nullable();
            $table->string('jour_4', 20)->nullable();

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
        Schema::dropIfExists('surveillances');
    }
}
