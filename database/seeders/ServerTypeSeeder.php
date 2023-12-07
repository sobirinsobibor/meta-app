<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $server_types = [
            [
                'server_type_name' => 'Virtual',
                'server_type_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'server_types_name' => 'Dedicated Server',
                'server_type_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('server_types')->insert($server_types);
    }
}
