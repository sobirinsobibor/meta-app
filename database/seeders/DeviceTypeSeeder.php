<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_types = [
            [
                'device_type_name'  => 'UPS',
                'device_type_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_type_name'  => 'Server',
                'device_type_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_type_name'  => 'Switch',
                'device_type_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_type_name'  => 'AP Wifi',
                'device_type_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ]
        ];
        DB::table('device_types')->insert($device_types);
    }
}
