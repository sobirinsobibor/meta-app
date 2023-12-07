<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessorServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'processor_amount_of_piece',
        'processor_amount_of_core',    
        'device_registration_id'
    ];


}
