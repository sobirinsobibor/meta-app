<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use App\Models\NetworkTopology;
use App\Http\Requests\StoreNetworkTopologyRequest;
use App\Http\Requests\UpdateNetworkTopologyRequest;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class NetworkTopologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.topologi-jaringan.index', [
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
        try{
            $validatedData = $request->validate([
               'network_topology_description' => 'required|max:151',
               'user_nip' => 'required|digits:18',
               'id_team_unit' => 'required',
               'id_user' => 'required',
               'file' => 'required|mimes:jpg,png,pdf|max:5120'
             ]);
            $validatedData['updated_at'] = now();
            $validatedData['created'] = now();

            $components = [
                'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
                'id_team_unit' => $request->id_team_unit,
                'id_menu' => "2",
                'model' => 'App\Models\NetworkTopology'
            ];

            $validatedData['network_topology_registration_id'] = $this->makeRegistrationId($components);
            if(!$validatedData['network_topology_registration_id']){
                return redirect('/staff/pendataan/topologi-jaringan')->with('message', ['text' => 'error in making id', 'class' => 'danger']);
            }

            $file = $request->file('file');
            $validatedData['network_topology_file_name'] = $validatedData['network_topology_registration_id'] . '_' . $this->renameFile($file->getClientOriginalName());
            $validatedData['network_topology_file_extension'] = $file->getClientOriginalExtension();

            NetworkTopology::create($validatedData);
            $file->storeAs('/files', $validatedData['network_topology_file_name']);
            return redirect('/staff/pendataan/topologi-jaringan')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(Exception $e){
            return redirect('/staff/pendataan/topologi-jaringan')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }
  
    /**
     * Display the specified resource.
     */
    public function show(NetworkTopology $topologi_jaringan, Request $request)
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
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        // $idUser = $user->id;
        $network_topologies = NetworkTopology::with(['team_unit', 'user'])->select([
            'network_topologies.id',
            'network_topologies.id_user',
            'network_topologies.id_team_unit',

            'network_topologies.created_at',
            'network_topology_registration_id',
            'network_topology_file_name',
            'network_topology_description',
            'network_topologies.user_nip',
            'users.user_full_name',
        ])->join('team_units', 'network_topologies.id_team_unit', '=', 'team_units.id')
          ->join('users', 'network_topologies.id_user', '=', 'users.id')
        //   ->join('files', "network_topologies.network_topology_registration_id", '=', 'files.'."'file_registration_id'")
          ->where('network_topologies.id_team_unit', '=', $idTeamUnit)
        //   ->where('network_topologies.id_user', '=', $idUser)
          ->orderBy('network_topologies.created_at', 'desc'); 
          
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($network_topologies)->make(true);

    }
}
