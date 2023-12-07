<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_registration_id';
    protected $fillable = [
        'device_registration_id',
        'device_name', 
        'device_purchase_year',
        'device_description',
        'device_active_status',
        'id_device_type',
        'id_device_brand',
        'id_team_unit',
        'id_menu',
    ];

    protected $table = 'devices';

    public function device_type()
    {
        return $this->belongsTo(DeviceType::class, 'id_device_type');
    }

    public function device_brand()
    {
        return $this->belongsTo(DeviceBrand::class, 'id_device_brand');
    }

    public function team_unit()
    {
        return $this->belongsTo(TeamUnit::class, 'id_team_unit');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }



}
