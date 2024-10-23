<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_services', function (Blueprint $table) {
            $table->id();
            $table->string('objet')->nullable();
            $table->longText('message')->nullable();;
            $table->string('source');
            $table->string('statut', 20);
            $table->string('fichier', 20)->nullable();

            $table->unsignedBigInteger('user_sender_id');
            $table->foreign('user_sender_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_receiver_id');
            $table->foreign('user_receiver_id')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('message_services');
    }
}
