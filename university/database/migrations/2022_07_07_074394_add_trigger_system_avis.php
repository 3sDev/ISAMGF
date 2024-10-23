<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerSystemAvis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER add_Item_avis AFTER INSERT ON `avis` FOR EACH ROW
        BEGIN
            INSERT INTO `notifsystems` (`notifmodel_id`, `idInfo`, `consulted`, `readed`, `created_at`, `updated_at`) VALUES (2, NEW.id, 0, 0, now(), now());
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `add_Item_avis`');
    }
}
