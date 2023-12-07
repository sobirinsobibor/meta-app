<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailIdentityServer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_device_category',
        'id_server_type',
        'server_function_name',
        'device_registration_id'
    ];

    public function device_category()
    {
        return $this->belongsTo(DeviceCategory::class, 'id_device_category');
    }

    public function server_type()
    {
        return $this->belongsTo(ServerType::class, 'id_server_type');
    }





}
