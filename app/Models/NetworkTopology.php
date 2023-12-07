<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkTopology extends Model
{
    use HasFactory;

    protected $primaryKey = 'network_topology_registration_id';
    protected $fillable = [
        'network_topology_registration_id',
        'network_topology_file_name',
        'network_topology_file_extension',
        'network_topology_description',
        'user_nip',
        'id_team_unit',
        'id_user'
    ];

    protected $casts = [
        'network_topology_registration_id' => 'string', 
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
