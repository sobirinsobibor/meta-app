<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_maintenance_name',
        'service_maintenance_active_status' 
    ];

    public function device_maintenance()
    {
        return $this->hasMany(DeviceMaintenance::class, 'id_maintenance_service');
    } 
}
