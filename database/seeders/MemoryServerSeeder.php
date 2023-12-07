<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemoryServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memory_servers = [
            [
                'device_registration_id' => '202310070901002',
                'memory_amount_of_piece' => '4',
                'memory_capacity_of_piece' => '100',
            ],
        ];

        DB::table('memory_servers')->insert($memory_servers);

    }
}
