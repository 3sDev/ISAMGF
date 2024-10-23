<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_students', function (Blueprint $table) {
            $table->id();
            $table->string('consulted',10);
            $table->string('readed',10);
            $table->unsignedBigInteger('notifmodel_id');
            $table->foreign('notifmodel_id')->references('id')->on('notifmodels')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idInfo');
            $table->foreign('idInfo')->references('id')->on('attendances')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('notification_students');
    }
}
