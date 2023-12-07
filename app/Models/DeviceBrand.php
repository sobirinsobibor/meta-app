<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceBrand extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_brand_name',
        'device_brand_active_status' 
    ];

    public function device()
    {
        return $this->hasMany(Device::class, 'id_device_brand');
    }

}
