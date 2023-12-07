<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaintenanceServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maintenance_services = [
            [
                'maintenance_service_name' => 'Reboot/Penggantian IP',
                'maintenance_service_active_status' => true
            ],
            [
                'maintenance_service_name' => 'Penambahan Part Server',
                'maintenance_service_active_status' => true
            ]
        ];
        DB::table('maintenance_services')->insert($maintenance_services);
    }
}
