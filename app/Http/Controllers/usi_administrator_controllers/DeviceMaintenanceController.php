<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\Device;
use App\Models\IPServer;
use App\Models\MemoryServer;
use App\Models\HardDiskServer;
use App\Models\ProcessorServer;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;
use App\Models\DeviceMaintenance;
use App\Models\MaintenanceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailIdentityServer;
use App\Http\Requests\StoreDeviceMaintenanceRequest;
use App\Http\Requests\UpdateDeviceMaintenanceRequest;

class DeviceMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.layanan-data-center.maintenance-perangkat.index', [
            'title' => 'Halaman Pemeliharaan Perangkat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $serverDevices = Device::with(['device_type', 'device_brand', 'team_unit'])->select([
            'devices.id',
            'devices.device_registration_id',
            'devices.device_name',

            'device_types.device_type_name',

            'device_brands.device_brand_name'
        ])->join('device_types', 'devices.id_device_type', '=', 'device_types.id')
          ->join('device_brands', 'devices.id_device_brand', '=', 'device_brands.id')
          ->where('devices.id_team_unit', '=', $idTeamUnit)
          ->where('devices.id_device_type', '=', 2) //2 untuk id server
          ->where('devices.id_menu', '=', 1) //1 untuk apabila prgkt tersebut belum tidak dalam dismantiling/maintenance/akan diinstal
          ->orderBy('devices.device_registration_id', 'desc')
          ->get(); 

        $maintenanceServices = MaintenanceService::select([
            'id',
            'maintenance_service_name'
        ])->get();


        return view('usi-administrator-layouts.layanan-data-center.maintenance-perangkat.create', [
            'title' => 'Halaman Tambah Pemeliharaan Perangkat',
            'serverDevices' => $serverDevices,
            'maintenanceServices' => $maintenanceServices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceMaintenanceRequest $request)
    {
        // dd($request);
        try{
            //making registration id
            $components = [
                'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
                'id_team_unit' => $request->id_team_unit,
                'id_menu' => "5",
                'model' => 'App\Models\DeviceMaintenance'
            ];

            $validatedData = $request->validate([
                'user_nip' => 'required',
                'id_team_unit' => 'required',
                'id_user' => 'required',
                'device_maintenance_booking_date' => 'required|date|after:tomorrow',
                'maintainable_part' => ['nullable', Rule::in(['hdd', 'memory'])], 
                'device_maintenance_note' => 'required',
                'device_registration_id' => 'required',
                'device_maintenance_booking_date' => 'required',
                'id_maintenance_service' => 'required'

            ]);
            $validatedData['device_maintenance_acceptance_status'] = 2;
            $validatedData['device_maintenance_registration_id'] =  $this->makeRegistrationId($components);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            try {
                DB::beginTransaction();
            
                DeviceMaintenance::create($validatedData);
                $device_update = Device::find($request->device_registration_id);
                if ($device_update) {
                    $device_update->update(['id_menu' => 5]); 
                    $device_update->save();
                }else{
                    return false;
                }
                
                // Jika semua perintah berhasil, konfirmasikan transaksi
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('/staff/layanan/pemeliharaan-perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);      
            }
        
            return redirect('/staff/layanan/pemeliharaan-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(Exception $e){
            return redirect('/staff/layanan/pemeliharaan-perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceMaintenance $pemeliharaan_perangkat)
    {
        try{
            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;
    
            //jika sudah dapat ip
            if(IPServer::where('device_registration_id', '=',  $pemeliharaan_perangkat->device_registration_id)->exists()){
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
                ->where('devices.device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
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
                ->where('devices.device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
                ->first();
            }

            $server_processors = ProcessorServer::select([
                'processor_amount_of_piece',
                'processor_amount_of_core'
            ])->where('device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
              ->first();
 
            $server_memories = MemoryServer::select([
                'memory_amount_of_piece',
                'memory_capacity_of_piece'
            ])->where('device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
              ->first();
            
            $server_hard_disks = HardDiskServer::select([
                'hard_disk_amount_of_piece',
                'hard_disk_capacity_of_piece'
            ])->where('device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
              ->first();

            $detail_identity_server = DetailIdentityServer::with(['server_type', 'device_category'])->select([
                'server_function_name',
                'server_types.server_type_name',
                'device_categories.device_category_name'
            ])->join('server_types', 'detail_identity_servers.id_server_type', '=', 'server_types.id')
              ->join('device_categories', 'detail_identity_servers.id_device_category', '=', 'device_categories.id')
              ->first();
                
            $registration_id = $pemeliharaan_perangkat->device_installation_registration_id;
            return view('usi-administrator-layouts.layanan-data-center.maintenance-perangkat.detail', [
                'title' => "Halaman Instalasi Perangkat",
                "registration_id" => $registration_id,
                'id_team_unit' => $idTeamUnit,
                'device_installation' => $pemeliharaan_perangkat,
                'server_device' => $serverDevice,
                'detail_identity_server' => $detail_identity_server,
                'server_hard_disks' => $server_hard_disks,
                'server_memories' => $server_memories,
                'server_processors' => $server_processors,
                'device_maintenance' => $pemeliharaan_perangkat,

            ]);
        }catch(Exception $e){
            return redirect('/staff/layanan/pemeliharaan-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

        // try{
        //     $user = auth()->user(); 
        //     $idTeamUnit = $user->id_team_unit;
    
        //     if ($pemeliharaan_perangkat->id_team_unit !== $idTeamUnit) {
        //         return redirect('/staff/layanan/pemeliharaan-perangkat/')->with('message', ['text' => 'Anda tidak memiliki izin untuk melihat dokumen', 'class' => 'danger']);
        //     }

        //     $serverDevice = Device::with(['device_type', 'device_brand', 'team_unit'])->select([
        //         'devices.id',
        //         'devices.device_registration_id',
        //         'devices.device_name',
        //         'devices.device_description',
        //         'devices.device_purchase_year',
    
        //         'device_types.device_type_name',
    
        //         'device_brands.device_brand_name'
        //     ])->join('device_types', 'devices.id_device_type', '=', 'device_types.id')
        //       ->join('device_brands', 'devices.id_device_brand', '=', 'device_brands.id')
        //       ->where('devices.device_registration_id', '=', $pemeliharaan_perangkat->device_registration_id)
        //       ->first(); 
        
        //     $registration_id = $pemeliharaan_perangkat->device_maintenance_registration_id;
        //     return view('usi-administrator-layouts.layanan-data-center.maintenance-perangkat.detail', [
        //         'title' => "Halaman Pemeliharaan Perangkat",
        //         "registration_id" => $registration_id,
        //         'id_team_unit' => $idTeamUnit,
        //         'device_maintenance' => $pemeliharaan_perangkat,
        //         'server_device' => $serverDevice
        //     ]);
        // }catch(Exception $e){
        //     return redirect('/staff/layanan/pemeliharaan-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceMaintenance $deviceMaintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceMaintenanceRequest $request, DeviceMaintenance $deviceMaintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceMaintenance $deviceMaintenance)
    {
        //
    }

    public function deviceMaintenanceJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $device_maintenances = DeviceMaintenance::with(['team_unit', 'user'])->select([
            'device_maintenances.id',
            'device_maintenances.id_user',
            'device_maintenances.id_team_unit',

            'device_maintenances.created_at',
            'device_maintenance_registration_id',
            'device_maintenance_acceptance_status',
            
            'users.user_full_name',
            'users.user_nip',
        ])->join('team_units', 'device_maintenances.id_team_unit', '=', 'team_units.id')
          ->join('users', 'device_maintenances.id_user', '=', 'users.id')
          ->where('device_maintenances.id_team_unit', '=', $idTeamUnit)
          ->orderBy('device_maintenances.created_at', 'desc'); 
          
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_maintenances)->make(true);
    }
}
