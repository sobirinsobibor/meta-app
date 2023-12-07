<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_unit_active_status', 
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_team_unit');
    }

    public function device()
    {
        return $this->hasMany(Device::class, 'id_team_unit');
    }

    public function network_topology()
    {
        return $this->hasMany(NetworkTopology::class, 'id_team_unit');
    } 

    public function wifi_mapping()
    {
        return $this->hasMany(WifiMapping::class, 'id_team_unit');
    } 

    public function file()
    {
        return $this->hasMany(File::class, 'id_team_unit');
    } 

    public function device_installation()
    {
        return $this->hasMany(DeviceInstalation::class, 'id_team_unit');
    } 

    public function device_maintenance()
    {
        return $this->hasMany(DeviceMaintenance::class, 'id_team_unit');
    } 

    public function device_dismantle()
    {
        return $this->hasMany(DeviceDismantle::class, 'id_team_unit');
    } 

}
