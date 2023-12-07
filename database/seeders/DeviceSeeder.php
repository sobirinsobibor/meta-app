<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [
                'device_registration_id' => '202310070201001',
                'device_name' => 'R. KPS Lantai 1',
                'device_purchase_year' => 2021,
                'device_description' => 'Warna Hitam, 24 Port 10/100 Smart Switch',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 1,
                'id_device_brand' => 1,
                'id_team_unit' => 2,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070201002',
                'device_name' => 'R. SPESIALIS KMB',
                'device_purchase_year' => 2021,
                'device_description' => 'warna hitam, untuk client ruang sekretariat & keuangan',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 1,
                'id_device_brand' => 4,
                'id_team_unit' => 2,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070901002',
                'device_name' => 'ROUTER UTAMA PASCA',
                'device_purchase_year' => 2021,
                'device_description' => 'MIKROTIK CCR 1036 8G 2S+, RUANG SERVER PASCA',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 1,
                'id_device_brand' => 4,
                'id_team_unit' => 9,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070801001',
                'device_name' => 'AP Unifi ruang administrasi',
                'device_purchase_year' => 2022,
                'device_description' => 'UAP-NanoHD, backboud internet',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 4,
                'id_device_brand' => 3,
                'id_team_unit' => 8,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070801002',
                'device_name' => 'DEPAN ADMIN',
                'device_purchase_year' => 2015,
                'device_description' => 'Model : UAP-AC-Pro',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 4,
                'id_device_brand' => 4,
                'id_team_unit' => 8,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070801003',
                'device_name' => 'SWITCH RUANG CASEMIX',
                'device_purchase_year' => 2020,
                'device_description' => 'DGS-1210-28 Gigabit Ethernet Switch',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 3,
                'id_device_brand' => 2,
                'id_team_unit' => 8,
                'id_menu' => 1
            ],
            [
                'device_registration_id' => '202310070801004',
                'device_name' => 'SWITCH SECURITY LANTAI 1',
                'device_purchase_year' => 2020,
                'device_description' => 'DGS-1210-28 Gigabit Ethernet Switch',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 2,
                'id_device_brand' => 2,
                'id_team_unit' => 8,
                'id_menu' => 1
            ],

            [
                'device_registration_id' => '202310070901001',
                'device_name' => 'R. KPS Lantai 1',
                'device_purchase_year' => 2021,
                'device_description' => 'Warna Hitam, 24 Port 10/100 Smart Switch',
                'device_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'id_device_type' => 1,
                'id_device_brand' => 1,
                'id_team_unit' => 9,
                'id_menu' => 1
            ],
            
        ];
        DB::table('devices')->insert($devices);
    }
}
