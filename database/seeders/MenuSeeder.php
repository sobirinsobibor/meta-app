<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'menu_name' => 'Pendataan Perangkat',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_name' => 'Topologi Jaringan',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_name' => 'Mapping Wifi',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_name' => 'Instalasi perangkat',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_name' => 'Maintenance Perangkat',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'menu_name' => 'Dismantle Perangkat',
                'menu_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
        DB::table('menus')->insert($menus);
    }
}
