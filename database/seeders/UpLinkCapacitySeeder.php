<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpLinkCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $up_link_capacities = [
            [
                'up_link_capacity_name' => '1',
                'up_link_capacity_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'up_link_capacity_name' => '10',
                'up_link_capacity_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'up_link_capacity_name' => '100',
                'up_link_capacity_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
        ];
        DB::table('up_link_capacities')->insert($up_link_capacities);
    }
}
