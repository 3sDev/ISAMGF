<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([

            [
                'id' => '1',
                'matricule' => '12354785',
                'nom' => 'Ben mahmoud',
                'prenom' => 'Salim',
                'email' => 'salim@gmail.com',
                'password' => bcrypt('salim1234'),
                'classe_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'matricule' => '81120658',
                'nom' => 'Nacer',
                'prenom' => 'Mahdi',
                'email' => 'mahdi@gmail.com',
                'password' => bcrypt('mahdi1234'),
                'classe_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'matricule' => '12354785',
                'nom' => 'Massaoudi',
                'prenom' => 'Wafa',
                'email' => 'wafa@gmail.com',
                'password' => bcrypt('wafa1234'),
                'classe_id' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
