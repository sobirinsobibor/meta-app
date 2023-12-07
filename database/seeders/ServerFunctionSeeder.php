<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServerFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $server_functions = [
            [
                'server_function_name' => 'Aplikasi',
                'server_function_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'server_function_name' => 'DataBase',
                'server_function_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'server_function_name' => 'Lainnya',
                'server_function_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ]

        ];
        DB::table('server_functions')->insert($server_functions);
    }
}
