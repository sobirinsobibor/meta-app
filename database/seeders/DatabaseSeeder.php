<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Device;
use App\Models\MaintenanceService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MaintenanceServiceSeeder::class);
        $this->call(DeviceBrandSeeder::class);
        $this->call(DeviceTypeSeeder::class);
        $this->call(DeviceCategorySeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TeamUnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(NetworkTopologySeeder::class);
        $this->call(WifiMappingSeeder::class);
        $this->call(DeviceInstallationSeeder::class);
        $this->call(DeviceMaintenanceSeeder::class);
        $this->call(DeviceDismantleSeeder::class);


        $this->call(HardDiskServerSeeder::class);
        $this->call(MemoryServerSeeder::class);
        $this->call(ProcessorServerSeeder::class);
        $this->call(ServerTypeSeeder::class);
        $this->call(ServerFunctionSeeder::class);

        $this->call(UpLinkTypeSeeder::class);
        $this->call(UpLinkCapacitySeeder::class);
        $this->call(UpLinkTransmissionSpeedSeeder::class);
        $this->call(UpLinkSeeder::class);
    }
}
