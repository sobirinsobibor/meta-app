<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpLinkTransmissionSpeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $up_link_transmission_speeds = [
            [
                'up_link_transmission_speed_name' => 'GBPS',
                'up_link_transmission_speed_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'up_link_transmission_speed_name' => 'MBPS',
                'up_link_transmission_speed_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
        ];
        DB::table('up_link_transmission_speeds')->insert($up_link_transmission_speeds);

    }
}
