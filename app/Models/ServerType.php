<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_type_name',
        'server_type_active_status' 
    ];

    public function detail_identity_server()
    {
        return $this->hasMany(DetailIdentityServer::class, 'id_server_type');
    } 

}
