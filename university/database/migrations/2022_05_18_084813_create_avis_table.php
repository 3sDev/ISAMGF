<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->longText('description')->nullable();
            $table->string('adresse', 150)->nullable();
            $table->string('date', 50)->nullable();
            $table->string('rating', 50)->nullable();
            $table->string('views', 50)->nullable();
            $table->string('image', 50)->nullable();
            $table->string('fichier', 50)->nullable();
            $table->string('type', 50)->nullable();

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
        Schema::dropIfExists('avis');
    }
}
