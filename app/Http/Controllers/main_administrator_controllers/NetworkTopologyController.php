<?php

namespace App\Http\Controllers\main_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\NetworkTopology;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNetworkTopologyRequest;
use App\Http\Requests\UpdateNetworkTopologyRequest;

class NetworkTopologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.pendataan-perangkat-jaringan.topologi-jaringan.index', [
            'title' => "Halaman Topologi Jaringan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNetworkTopologyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NetworkTopology $topologi_jaringan)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NetworkTopology $networkTopology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNetworkTopologyRequest $request, NetworkTopology $networkTopology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NetworkTopology $networkTopology)
    {
        //
    }
    
    //datatable
    public function networkTopologyJson(){

        $network_topologies = NetworkTopology::with(['team_unit', 'user'])->select([
            'network_topologies.id',
            'network_topologies.id_user',
            'network_topologies.id_team_unit',

            'network_topologies.created_at',
            'network_topology_registration_id',
            'network_topology_description',
            'network_topology_file_name',
            'network_topologies.user_nip',
            'users.user_full_name',
            'team_units.team_unit_name'
        ])->join('team_units', 'network_topologies.id_team_unit', '=', 'team_units.id')
          ->join('users', 'network_topologies.id_user', '=', 'users.id')
          ->orderBy('network_topologies.created_at', 'desc'); 
          
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($network_topologies)->make(true);

    }

}

// 