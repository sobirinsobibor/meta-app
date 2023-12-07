<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryServer extends Model
{
    use HasFactory;
    protected $fillable = [
        'memory_amount_of_piece',
        'memory_capacity_of_piece',
        'device_registration_id'
    ];

}
