<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $up_links = [
            'id_up_link_type' => '1',
            'id_up_link_capacity' => '1',
            'id_up_link_transmission_speed' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('up_links')->insert($up_links);

    }
}
