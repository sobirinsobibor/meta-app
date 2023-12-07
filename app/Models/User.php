<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    protected $fillable = [
        'user_active_status', 
    ];

    protected $casts = [
        'user_nip' => 'string', 
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function team_unit()
    {
        return $this->belongsTo(TeamUnit::class, 'id_team_unit');
    }

    public function network_topology()
    {
        return $this->hasMany(NetworkTopology::class, 'id_user');
    } 

    public function wifi_mapping()
    {
        return $this->hasMany(WifiMapping::class, 'id_user');
    } 

    public function device_installation()
    {
        return $this->hasMany(DeviceInstalation::class, 'id_user');
    } 

    public function device_maintenance()
    {
        return $this->hasMany(DeviceMaintenance::class, 'id_user');
    } 

}
