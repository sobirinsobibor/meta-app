<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HardDiskServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hard_disk_servers = [
            [
                'device_registration_id' => '202310070901002',
                'hard_disk_amount_of_piece' => '4',
                'hard_disk_capacity_of_piece' => '100',
            ],
        ];

        DB::table('hard_disk_servers')->insert($hard_disk_servers);

    }
}
