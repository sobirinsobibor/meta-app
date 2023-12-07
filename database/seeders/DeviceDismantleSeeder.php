<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceDismantleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_dismantles = [
            [
                'device_dismantle_registration_id' => '202310020806001',
                'device_dismantle_reason' => '',
                'device_dismantle_acceptance_status' => 2,
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8,
                'device_registration_id' => '202310070801003',
                'device_dismantle_file_name' => 'test.pdf',
                'device_dismantle_file_extension' => '.pdf',
                'device_dismantle_booking_date' => now()->addDay()
            ],
            [
                'device_dismantle_registration_id' => '202310020806002',
                'device_dismantle_message_from_dsi' => '',
                'device_dismantle_acceptance_status' => 2,
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8,
                'device_registration_id' => '202310070801003',
                'device_dismantle_file_name' => 'test.pdf',
                'device_dismantle_file_extension' => '.pdf',
                'device_dismantle_booking_date' => now()->addDay()
            ],
            [
                'device_dismantle_registration_id' => '202310020906001',
                'device_dismantle_message_from_dsi' => '',
                'device_dismantle_acceptance_status' => 2,
                'created_at' => now(),
                'id_user' => 4,
                'user_nip' => '199402182021025101',
                'id_team_unit' => 9,
                'device_registration_id' => '202310070801003',
                'device_dismantle_file_name' => 'test.pdf',
                'device_dismantle_file_extension' => '.pdf',
                'device_dismantle_booking_date' => now()->addDay()
            ],
        ];
        DB::table('device_dismantles')->insert($device_dismantles);
    }
}
