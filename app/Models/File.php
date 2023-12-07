<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $primaryKey = 'file_registration_id';
    protected $casts = [
        'file_registration_id' => 'string', 
    ];
    protected $fillable = [
        'file_name',
        'file_extension',
        'file_registration_id',
        'id_team_unit'
    ];

    public function team_unit()
    {
        return $this->belongsTo(TeamUnit::class, 'id_team_unit');
    }

    public function network_topology()
    {
        return $this->belongsTo(NetworkTopology::class, 'network_topology_registration_id', 'file_registration_id');
    }

}
