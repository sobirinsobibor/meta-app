<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NetworkTopologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $network_topologies = [
            [
                'network_topology_registration_id' => '202309240802001',
                'network_topology_description' => "topologi jaringan setelah ada peremajaan kabel akhir 2021",
                'created_at' => now(),
                'updated_at' => now(),
                'network_topology_file_name' => 'test.pdf',
                'network_topology_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'network_topology_registration_id' => '202309240802002',
                'network_topology_description' => "Topologi jaringan DSI",
                'created_at' => now(),
                'updated_at' => now(),
                'network_topology_file_name' => 'test.pdf',
                'network_topology_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'network_topology_registration_id' => '202309240802003',
                'network_topology_description' => "Topologi jaringan Kedokteran",
                'created_at' => now(),
                'updated_at' => now(),
                'network_topology_file_name' => 'test.pdf',
                'network_topology_file_extension' => '.pdf',
                'id_user' => 2,
                'user_nip' => '199805152022045101',
                'id_team_unit' => 8
            ],
            [
                'network_topology_registration_id' => '202309240902001',
                'network_topology_description' => "Topologi jaringan Dir SDM",
                'created_at' => now(),
                'updated_at' => now(),
                'network_topology_file_name' => 'test.pdf',
                'network_topology_file_extension' => '.pdf',
                'id_user' => 4,
                'user_nip' => '199402182021025101',
                'id_team_unit' => 9
            ],
        ];
        DB::table('network_topologies')->insert($network_topologies);
    }
}
