<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $device_categories = [
            [
                'device_category_name'  => 'Unifi',
                'device_category_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_category_name'  => 'Aruba',
                'device_category_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
            [
                'device_category_name'  => 'Backbone',
                'device_category_active_status' => 1,
                'created_at' => now(),  
                'updated_at' => now()
            ],
        ];
        DB::table('device_categories')->insert($device_categories);

    }
}
