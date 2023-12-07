<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceMaintenance extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_maintenance_registration_id';
    protected $fillable = [
        'device_maintenance_registration_id',
        'device_maintenance_note',
        'device_maintenance_message_from_dsi',
        'device_maintenance_acceptance_status',
        'device_maintenance_booking_date',
        'device_registration_id',
        'maintainable_part',
        'user_nip',
        'id_team_unit',
        'id_user',
        'id_maintenance_service'
    ];

    public function team_unit()
    {
        return $this->belongsTo(TeamUnit::class, 'id_team_unit');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function maintenance_service()
    {
        return $this->belongsTo(MaintenanceService::class, 'id_maintenance_service');
    }

}
