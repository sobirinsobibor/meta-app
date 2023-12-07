<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInstallation extends Model
{
    use HasFactory;

    protected $primaryKey = 'device_installation_registration_id';
    protected $fillable = [
        'device_installation_registration_id',
        'device_registration_id',
        'device_installation_acceptance_status',
        'device_installation_file_name',
        'device_installation_file_extension',
        'device_installation_message_from_dsi',
        'device_installation_booking_date',
        'user_nip',
        'id_team_unit',
        'id_user'
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
