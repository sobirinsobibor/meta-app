<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_type_name',
        'device_type_active_status' 
    ];

    public function device()
    {
        return $this->hasMany(Device::class, 'id_device_type');
    }
}
