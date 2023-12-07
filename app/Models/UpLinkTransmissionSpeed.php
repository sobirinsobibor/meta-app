<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpLinkTransmissionSpeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'up_link_transmission_speed_name',
        'up_link_transmission_active_status'
    ];

    public function up_link(){
        return $this->hasMany(UpLink::class, 'id_up_transmission_speed');
    }

}
