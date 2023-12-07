<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiMapping extends Model
{
    use HasFactory;

    protected $primaryKey = 'wifi_mapping_registration_id';
    protected $fillable = [
        'wifi_mapping_registration_id',
        'wifi_mapping_description',
        'wifi_mapping_file_name',
        'wifi_mapping_file_extension',
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
