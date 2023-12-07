<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team_units = [
            [
                'team_unit_name' => 'Airlangga Assessment Center',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Airlangga Global Engangement',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Badan Pengawas Internal',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Badan Pengembangan Bisnis Rintisan dan Inkubasi',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Direktorat Inovasi dan Pengembangan Pendidikan',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Direktorat Kemahasiswaan',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Direktorat Keuangan',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Direktorat Sistem Informasi dan Digitalisasi',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Direktorat Sumber Daya Manusia',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'team_unit_name' => 'Fakultas Vokasi',
                'team_unit_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('team_units')->insert($team_units);
    }
}
