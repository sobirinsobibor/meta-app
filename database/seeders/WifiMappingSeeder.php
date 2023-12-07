<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WifiMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wifi_mappings = [
            [
                'wifi_mapping_registration_id' => '202309240803001',
                'wifi_mapping_description' => "Wifi mapping  setelah ada peremajaan kabel akhir 2021",
                'created_at' => now(),
                'updated_at' => now(),
                'wifi_mapping_file_name' => 'test.pdf',
                'wifi_mapping_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'wifi_mapping_registration_id' => '202309240803002',
                'wifi_mapping_description' => "wifi mapping DSI",
                'created_at' => now(),
                'updated_at' => now(),
                'wifi_mapping_file_name' => 'test.pdf',
                'wifi_mapping_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'wifi_mapping_registration_id' => '202309240803003',
                'wifi_mapping_description' => "Wifi Mapping Kedokteran",
                'created_at' => now(),
                'updated_at' => now(),
                'wifi_mapping_file_name' => 'test.pdf',
                'wifi_mapping_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'wifi_mapping_registration_id' => '202309240903001',
                'wifi_mapping_description' => "wifi mapping jaringan Dir SDM",
                'created_at' => now(),
                'updated_at' => now(),
                'wifi_mapping_file_name' => 'test.pdf',
                'wifi_mapping_file_extension' => '.pdf',
                'id_user' => 4,
                'user_nip' => '199402182021025101',
                'id_team_unit' => 9
            ],
        ];
        DB::table('wifi_mappings')->insert($wifi_mappings);
    }
}
