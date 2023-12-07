<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_nip' => "199002232020063101",
                'user_full_name' => 'RAIESA RACHMAN',
                'user_email' => 'raiesa.rachman@staf.unair.ac.id',
                'user_phone' => '08113187123',
                'password' => bcrypt('pass'),
                'user_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 1,
                'id_team_unit' => 8
            ],
            [
                'user_nip' => '199805152022045101',
                'user_full_name' => 'AUDI SURYA PRATAMA',
                'user_email' => 'audi.surya@staf.unair.ac.id',
                'user_phone' => '081234692930',
                'password' => bcrypt('pass'),
                'user_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 2,
                'id_team_unit' => 8
            ],
            [
                'user_nip' => '199611262022045101',
                'user_full_name' => 'AMIR IBNU ALFIAN',
                'user_email' => 'amir.ibnu@staf.unair.ac.id',
                'user_phone' => '082140840222',
                'password' => bcrypt('pass'),
                'user_active_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 3,
                'id_team_unit' => 8
            ],
            [
                'user_nip' => '199402182021025101',
                'user_full_name' => 'MUHAMMAD RIZAL RAMDHANI',
                'user_email' => 'm.rizal.ramdhani@staf.unair.ac.id',
                'user_phone' => '081357153621',
                'password' => bcrypt('pass'),
                'user_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 2,
                'id_team_unit' => 9
            ],
            [
                'user_nip' => '199803092022045201',
                'user_full_name' =>'Eka Ayu Amelia Putri',
                'user_email' => 'eka.ayu.amelia@staf.unair.ac.id',
                'user_phone' => '08123456789',
                'password' => bcrypt('pass'),
                'user_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_role' => 2,
                'id_team_unit' => 9
            ]

        ];
        DB::table('users')->insert($users);
    }
}
