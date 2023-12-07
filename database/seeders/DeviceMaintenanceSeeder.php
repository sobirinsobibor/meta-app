<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_maintenances = [
            [
                'device_maintenance_registration_id' => '202310020805001',
                'device_maintenance_note' => '',
                'device_maintenance_acceptance_status' => 2,
                'device_registration_id' => '202310070801004',
                "maintainable_part" => "hdd",
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8,
                "id_maintenance_service" => "2",
                'device_maintenance_booking_date' => now()->addDay()
            ],
            [
                'device_maintenance_registration_id' => '202310020805002',
                'device_maintenance_note' => '',
                'device_maintenance_acceptance_status' => 2,
                'device_registration_id' => '202310070801004',
                "maintainable_part" => "",
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8,
                "id_maintenance_service" => "1",
                'device_maintenance_booking_date' => now()->addDay()
            ],
            [
                'device_maintenance_registration_id' => '202310020905001',
                'device_maintenance_note' => '',
                'device_maintenance_acceptance_status' => 2,
                'device_registration_id' => '202310070801004',
                "maintainable_part" => "hdd",
                'created_at' => now(),
                'id_user' => 4,
                'user_nip' => '199402182021025101',
                'id_team_unit' => 9,
                "id_maintenance_service" => "2",
                'device_maintenance_booking_date' => now()->addDay()
            ],
        ];
        DB::table('device_maintenances')->insert($device_maintenances);
    }
}
