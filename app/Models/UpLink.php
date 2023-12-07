<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_up_link_capacity',
        'id_up_link_type',
        'id_up_link_transmission_speed',
        'up_link_active_status'
    ];

    public function up_link_type()
    {
        return $this->belongsTo(UpLinkType::class, 'id_up_link_type');
    }

    public function up_link_capacity()
    {
        return $this->belongsTo(UpLinkCapacity::class, 'id_up_link_capacity');
    }

    public function up_link_transmission_speed()
    {
        return $this->belongsTo(UpLinkTransmissionSpeed::class, 'id_up_link_transmission_speed');
    }

}
