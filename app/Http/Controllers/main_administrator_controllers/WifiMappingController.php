<?php

namespace App\Http\Controllers\main_administrator_controllers;

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
        return view('main-administrator-layouts.pendataan-perangkat-jaringan.mapping-wifi.index', [
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WifiMapping $mapping_wifi)
    {
        try{
            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;

            $files = File::with('team_unit') 
                            ->where('file_registration_id', $mapping_wifi->wifi_mapping_registration_id)
                            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at 
                            ->get();
            $registration_id = $mapping_wifi->wifi_mapping_registration_id;

            return view('main-administrator-layouts.pendataan-perangkat-jaringan.mapping-wifi.detail', [
                'title' => "Halaman Mapping wifi",
                'files' => $files,
                "registration_id" => $registration_id,
                'id_team_unit' => $idTeamUnit
            ]);

        }catch(Exception $e){
            return redirect('/admin/pendataan/mapping-wifi/')->with('message', ['text' => $e, 'class' => 'danger']);
        }
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
            'team_units.team_unit_name'
        ])->join('team_units', 'wifi_mappings.id_team_unit', '=', 'team_units.id')
          ->join('users', 'wifi_mappings.id_user', '=', 'users.id')
          ->orderBy('wifi_mappings.created_at', 'desc'); 
          
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($wifi_mappings)->make(true);

    }

}
