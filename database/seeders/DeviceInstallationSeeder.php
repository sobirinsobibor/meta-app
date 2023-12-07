<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceInstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_installations = [
            [
                'device_installation_registration_id' => '202309300804001',
                'device_registration_id' => '202310070201001',
                'device_installation_acceptance_status' => 2,
                'device_installation_file_name' => 'test.pdf',
                'device_installation_file_extension' => '.pdf',
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'device_installation_registration_id' => '202309300804002',
                'device_registration_id' => '202310070201002',
                'device_installation_acceptance_status' => 2,
                'device_installation_file_name' => 'test.pdf',
                'device_installation_file_extension' => '.pdf',
                'created_at' => now(),
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'device_installation_registration_id' => '202309300904001',
                'device_registration_id' => '202310070901002',
                'device_installation_acceptance_status' => 2,
                'device_installation_file_name' => 'test.pdf',
                'device_installation_file_extension' => '.pdf',
                'created_at' => now(),
                'id_user' => 5,
                'user_nip' => '199803092022045201',
                'id_team_unit' => 9
            ],
        ];
        DB::table('device_installations')->insert($device_installations);

    }
}
