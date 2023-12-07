<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPServer extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_server_name',
        'ip_server_manage_name',
        'device_registration_id'
    ];
}
