<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceDismantle extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_dismantle_registration_id';
    protected $fillable = [
        'device_dismantle_registration_id',
        'device_dismantle_reason',
        'device_dismantle_acceptance_status',
        'user_nip',
        'id_team_unit',
        'id_user',
        'device_registration_id',
        'device_dismantle_booking_date',
        'device_dismantle_message_from_dsi',
        'device_dismantle_file_name',
        'device_dismantle_file_extension'
    ];

    public function team_unit()
    {
        return $this->belongsTo(TeamUnit::class, 'id_team_unit');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
