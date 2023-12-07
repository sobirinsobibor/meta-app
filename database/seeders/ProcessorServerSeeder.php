<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProcessorServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processor_servers = [
            [
                'device_registration_id' => '202310070901002',
                'processor_amount_of_piece' => '4',
                'processor_amount_of_core' => '3',
            ],
        ];

        DB::table('processor_servers')->insert($processor_servers);

    }
}
