<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\WifiMapping;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWifiMappingRequest;
use App\Http\Requests\UpdateWifiMappingRequest;

class WifiMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.mapping-wifi.index', [
            'title' => "Halaman Mapping Wifi"
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
    public function store(StoreWifiMappingRequest $request)
    {
        try{
            $validatedData = $request->validate([
               'wifi_mapping_description' => 'required|max:151',
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
                'id_menu' => "3",
                'model' => 'App\Models\WifiMapping'
            ];

            $validatedData['wifi_mapping_registration_id'] = $this->makeRegistrationId($components);
            if(!$validatedData['wifi_mapping_registration_id']){
                return redirect('/staff/pendataan/mapping-wifi')->with('message', ['text' => 'error in making id', 'class' => 'danger']);
            }

            $file = $request->file('file');
            $validatedData['wifi_mapping_file_name'] = $validatedData['wifi_mapping_registration_id'] . '_' .$this->renameFile($file->getClientOriginalName());
            $validatedData['wifi_mapping_file_extension'] = $file->getClientOriginalExtension();

            WifiMapping::create($validatedData);
            $file->storeAs('/files', $validatedData['wifi_mapping_file_name']);
            return redirect('/staff/pendataan/mapping-wifi')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(Exception $e){
            return redirect('/staff/pendataan/mapping-wifi')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WifiMapping $mapping_wifi)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WifiMapping $wifiMapping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWifiMappingRequest $request, WifiMapping $wifiMapping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WifiMapping $wifiMapping)
    {
        //
    }

    public function mappingWifiJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $wifi_mappings = WifiMapping::with(['team_unit', 'user'])->select([
            'wifi_mappings.id',
            'wifi_mappings.id_user',
            'wifi_mappings.id_team_unit',

            'wifi_mappings.created_at',
            'wifi_mapping_registration_id',
            'wifi_mapping_file_name',
            'wifi_mapping_description',
            'wifi_mappings.user_nip',
            'users.user_full_name',
        ])->join('team_units', 'wifi_mappings.id_team_unit', '=', 'team_units.id')
          ->join('users', 'wifi_mappings.id_user', '=', 'users.id')
          ->where('wifi_mappings.id_team_unit', '=', $idTeamUnit)
          ->orderBy('wifi_mappings.created_at', 'desc'); 
          
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($wifi_mappings)->make(true);

    }
}
