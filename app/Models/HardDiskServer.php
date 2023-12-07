<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardDiskServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'hard_disk_amount_of_piece',
        'hard_disk_capacity_of_piece',
        'device_registration_id'
    ];


}
