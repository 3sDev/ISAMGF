<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAbsenceStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER add_absence_student AFTER INSERT ON `attendances` FOR EACH ROW
        BEGIN
            INSERT INTO `notification_students` (`consulted`, `readed`, `notifmodel_id`, `idInfo`, `created_at`, `updated_at`) 
            VALUES (0, 0, 4, NEW.id, now(), now());
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `add_absence_student`');
    }
}
