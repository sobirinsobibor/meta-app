<?php

namespace App\Http\Controllers\main_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\Device;
use App\Models\IPServer;
use Yajra\Datatables\Datatables;
use App\Models\DeviceInstallation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviceInstallationRequest;
use App\Http\Requests\UpdateDeviceInstallationRequest;
use App\Models\DetailIdentityServer;
use App\Models\HardDiskServer;
use App\Models\MemoryServer;
use App\Models\ProcessorServer;

class DeviceInstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.layanan-data-center.instalasi-perangkat.index', [
            'title' => 'Halaman Instalasi Perangkat',
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
    public function store(StoreDeviceInstallationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceInstallation $instalasi_perangkat)
    {
        try{
            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;
    
            //jika sudah dapat ip
            if(IPServer::where('device_registration_id', '=',  $instalasi_perangkat->device_registration_id)->exists()){
                $serverDevice = Device::with(['device_type', 'device_brand', 'team_unit'])->select([
                    'devices.id',
                    'devices.device_registration_id',
                    'devices.device_name',
                    'devices.device_description',
                    'devices.device_purchase_year',
        
                    'device_types.device_type_name',
        
                    'device_brands.device_brand_name',

                    'i_p_servers.ip_server_name',
                    'i_p_servers.ip_server_manage_name'
                ])->join('device_types', 'devices.id_device_type', '=', 'device_types.id')
                ->join('device_brands', 'devices.id_device_brand', '=', 'device_brands.id')
                ->join('i_p_servers', 'devices.device_registration_id', '=', 'i_p_servers.device_registration_id')
                ->where('devices.device_registration_id', '=', $instalasi_perangkat->device_registration_id)
                ->first();
            }else{
                $serverDevice = Device::with(['device_type', 'device_brand', 'team_unit'])->select([
                    'devices.id',
                    'devices.device_registration_id',
                    'devices.device_name',
                    'devices.device_description',
                    'devices.device_purchase_year',
        
                    'device_types.device_type_name',
        
                    'device_brands.device_brand_name',

                ])->join('device_types', 'devices.id_device_type', '=', 'device_types.id')
                ->join('device_brands', 'devices.id_device_brand', '=', 'device_brands.id')
                ->where('devices.device_registration_id', '=', $instalasi_perangkat->device_registration_id)
                ->first();
            }

            $server_processors = ProcessorServer::select([
                'processor_amount_of_piece',
                'processor_amount_of_core'
            ])->where('device_registration_id', '=', $instalasi_perangkat->device_registration_id)
              ->first();
 
            $server_memories = MemoryServer::select([
                'memory_amount_of_piece',
                'memory_capacity_of_piece'
            ])->where('device_registration_id', '=', $instalasi_perangkat->device_registration_id)
              ->first();
            
            $server_hard_disks = HardDiskServer::select([
                'hard_disk_amount_of_piece',
                'hard_disk_capacity_of_piece'
            ])->where('device_registration_id', '=', $instalasi_perangkat->device_registration_id)
              ->first();

            $detail_identity_server = DetailIdentityServer::with(['server_type', 'device_category'])->select([
                'server_function_name',
                'server_types.server_type_name',
                'device_categories.device_category_name'
            ])->join('server_types', 'detail_identity_servers.id_server_type', '=', 'server_types.id')
              ->join('device_categories', 'detail_identity_servers.id_device_category', '=', 'device_categories.id')
              ->first();
                
            $registration_id = $instalasi_perangkat->device_installation_registration_id;
            return view('main-administrator-layouts.layanan-data-center.instalasi-perangkat.detail', [
                'title' => "Halaman Instalasi Perangkat",
                "registration_id" => $registration_id,
                'id_team_unit' => $idTeamUnit,
                'device_installation' => $instalasi_perangkat,
                'server_device' => $serverDevice,
                'detail_identity_server' => $detail_identity_server,
                'server_hard_disks' => $server_hard_disks,
                'server_memories' => $server_memories,
                'server_processors' => $server_processors
            ]);
        }catch(Exception $e){
            return redirect('/admin/layanan/instalasi-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceInstallation $deviceInstallation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceInstallationRequest $request, DeviceInstallation $instalasi_perangkat)
    {
        try{
            $validatedData = $request->validate([
                'device_installation_message_from_dsi' => 'required|max:501',
                'device_installation_acceptance_status' => 'required',
                'updated_at' => 'required',
            ]);
            $validatedData['device_installation_booking_date'] = $request->device_installation_booking_date;

            $device_installation_update = DeviceInstallation::find($instalasi_perangkat->device_installation_registration_id);
            if (!$device_installation_update) {
                return redirect('/staff/layanan/instalasi-perangkat')->with('message', ['text' => 'Device not found', 'class' => 'danger']);
            }
            
            $device_installation_update->update($validatedData);
            return redirect('/admin/layanan/instalasi-perangkat')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(Exception $e){
            return redirect('/admin/layanan/instalasi-perangkat/'.$instalasi_perangkat->device_installation_registration_id)->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceInstallation $deviceInstallation)
    {
        //
    }

    public function deviceInstallationJson(){
        $device_installations = DeviceInstallation::with(['team_unit', 'user'])->select([
            'device_installations.id',
            'device_installations.id_user',
            'device_installations.id_team_unit',

            'device_installations.created_at',
            'device_installation_registration_id',
            'device_installation_acceptance_status',
            
            'users.user_full_name',
            'users.user_nip',

            'team_units.team_unit_name'
        ])->join('team_units', 'device_installations.id_team_unit', '=', 'team_units.id')
          ->join('users', 'device_installations.id_user', '=', 'users.id')
          ->orderBy('device_installations.created_at', 'desc'); 
          
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_installations)->make(true);
    }

}
