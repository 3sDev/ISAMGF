<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifsystems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notifmodel_id');
            $table->foreign('notifmodel_id')->references('id')->on('notifmodels')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('idInfo');
            $table->string('consulted',10);
            $table->string('readed',10);
            
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
        Schema::dropIfExists('notifsystems');
    }
}
