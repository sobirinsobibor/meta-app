<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_brands = [
            [
                'device_brand_name'  => 'AOC',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_brand_name'  => 'Aruba',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                
                'device_brand_name'  => 'Cisco',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                
                'device_brand_name'  => 'MikroTik',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                
                'device_brand_name'  => 'Tp-link',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                
                'device_brand_name'  => 'ZTE',
                'device_brand_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ]
        ];
        DB::table('device_brands')->insert($device_brands);
    }
}
