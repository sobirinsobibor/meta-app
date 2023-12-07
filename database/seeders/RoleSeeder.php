<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role_name' => 'main-administrator',
                'role_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name' => 'usi-administrator',
                'role_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name' => 'visitor',
                'role_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('roles')->insert($roles);
    }
}
