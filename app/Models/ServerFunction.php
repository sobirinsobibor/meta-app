<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_function_active_status' ,
        'server_function_name' 
    ];
}
