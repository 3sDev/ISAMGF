<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiTokenStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('api_token',255)->nullable();
            $table->string('date_token',60)->nullable();
            $table->string('expires_at',60)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('api_token',255)->nullable();
            $table->string('date_token',60)->nullable();
            $table->string('expires_at',60)->nullable();
        });
    }
}
