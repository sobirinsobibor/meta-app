<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpLinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $up_link_types = [
            [
                'up_link_type_name' => 'UTP',
                'up_link_type_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'up_link_type_name' => 'FIBER',
                'up_link_type_active_status' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
        ];
        DB::table('up_link_types')->insert($up_link_types);

    }
}
