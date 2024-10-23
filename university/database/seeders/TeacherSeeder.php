<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([

            [
                'id' => '1',
                'cin' => '09124321',
                'nom' => 'Salhi',
                'prenom' => 'Fahmi',
                'email' => 'fahmi@gmail.com',
                'password' => bcrypt('fahmi1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'cin' => '06123123',
                'nom' => 'Thabet',
                'prenom' => 'Monji',
                'email' => 'monji@gmail.com',
                'password' => bcrypt('monji1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
