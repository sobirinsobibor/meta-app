<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_category_name',
        'device_category_active_status' 
    ];

    public function detail_identity_server()
    {
        return $this->hasMany(DetailIdentityServer::class, 'id_device_category');
    } 

}
