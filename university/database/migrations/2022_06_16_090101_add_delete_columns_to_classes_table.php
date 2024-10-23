<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteColumnsToClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            //$table->dropColumn(['department_id', 'section_id', 'level_id']);
            $table->unsignedBigInteger('level_sections_id');
            $table->foreign('level_sections_id')->references('id')->on('level_sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            // $table->integer('department_id');
            // $table->integer('section_id');
            // $table->integer('level_id');
            $table->dropColumn('level_sections_id');
        });
    }
}
