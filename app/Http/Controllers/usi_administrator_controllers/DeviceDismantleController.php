<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\Device;
use App\Models\IPServer;
use App\Models\MemoryServer;
use App\Models\HardDiskServer;
use App\Models\DeviceDismantle;
use App\Models\ProcessorServer;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailIdentityServer;
use App\Http\Requests\StoreDeviceDismantleRequest;
use App\Http\Requests\UpdateDeviceDismantleRequest;

class DeviceDismantleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.layanan-data-center.dismantle-perangkat.index', [
            'title' => 'Halaman Pelepasan Perangkat',
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

        return view('usi-administrator-layouts.layanan-data-center.dismantle-perangkat.create', [
            'title' => 'Halaman Tambah Pelepasan Perangkat',
            'serverDevices' => $serverDevices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceDismantleRequest $request)
    {
        try{
            
            //making registration id
            $components = [
                'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
                'id_team_unit' => $request->id_team_unit,
                'id_menu' => "6",
                'model' => 'App\Models\DeviceDismantle'
            ];

            $validatedData = $request->validate([
                'user_nip' => 'required',
                'id_team_unit' => 'required',
                'id_user' => 'required',
                'file' => 'required|mimes:jpg,png,pdf|max:5120',
                'device_dismantle_reason' => 'required',
                'device_dismantle_booking_date' => 'required|date|after:tomorrow',
                'device_registration_id' => 'required',
            ]);
            $validatedData['device_dismantle_acceptance_status'] = 2;
            $validatedData['device_dismantle_registration_id'] =  $this->makeRegistrationId($components);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            $file = $request->file('file');
            $validatedData['device_dismantle_file_name'] = $validatedData['device_dismantle_registration_id'] . '_' . $this->renameFile($file->getClientOriginalName());
            $validatedData['device_dismantle_file_extension'] = $file->getClientOriginalExtension();

            try {
                DB::beginTransaction();
            
                DeviceDismantle::create($validatedData);
                $file->storeAs('/files', $validatedData['device_dismantle_file_name']);

                $device_update = Device::find($request->device_registration_id);
                if ($device_update) {
                    $device_update->update(['id_menu' => 6]); 
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


            return redirect('/staff/layanan/pelepasan-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(Exception $e){
            return redirect('/staff/layanan/pelepasan-perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceDismantle $pelepasan_perangkat)
    {
        try{
            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;
    
            //jika sudah dapat ip
            if(IPServer::where('device_registration_id', '=',  $pelepasan_perangkat->device_registration_id)->exists()){
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
                ->where('devices.device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
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
                ->where('devices.device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
                ->first();
            }

            $server_processors = ProcessorServer::select([
                'processor_amount_of_piece',
                'processor_amount_of_core'
            ])->where('device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
              ->first();
 
            $server_memories = MemoryServer::select([
                'memory_amount_of_piece',
                'memory_capacity_of_piece'
            ])->where('device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
              ->first();
            
            $server_hard_disks = HardDiskServer::select([
                'hard_disk_amount_of_piece',
                'hard_disk_capacity_of_piece'
            ])->where('device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
              ->first();

            $detail_identity_server = DetailIdentityServer::with(['server_type', 'device_category'])->select([
                'server_function_name',
                'server_types.server_type_name',
                'device_categories.device_category_name'
            ])->join('server_types', 'detail_identity_servers.id_server_type', '=', 'server_types.id')
              ->join('device_categories', 'detail_identity_servers.id_device_category', '=', 'device_categories.id')
              ->first();
                
            $registration_id = $pelepasan_perangkat->device_installation_registration_id;
            return view('usi-administrator-layouts.layanan-data-center.dismantle-perangkat.detail', [
                'title' => "Halaman Instalasi Perangkat",
                "registration_id" => $registration_id,
                'id_team_unit' => $idTeamUnit,
                'device_installation' => $pelepasan_perangkat,
                'server_device' => $serverDevice,
                'detail_identity_server' => $detail_identity_server,
                'server_hard_disks' => $server_hard_disks,
                'server_memories' => $server_memories,
                'server_processors' => $server_processors,
                'device_maintenance' => $pelepasan_perangkat,
                'device_dismantle' => $pelepasan_perangkat,
            ]);
        }catch(Exception $e){
            return redirect('/staff/layanan/pelepasan-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

        // try{
        //     $user = auth()->user(); 
        //     $idTeamUnit = $user->id_team_unit;
    
        //     if ($pelepasan_perangkat->id_team_unit !== $idTeamUnit) {
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
        //       ->where('devices.device_registration_id', '=', $pelepasan_perangkat->device_registration_id)
        //       ->first(); 

        //     $registration_id = $pelepasan_perangkat->device_dismantle_registration_id;
        //     return view('usi-administrator-layouts.layanan-data-center.dismantle-perangkat.detail', [
        //         'title' => "Halaman Pemeliharaan Perangkat",
        //         "registration_id" => $registration_id,
        //         'id_team_unit' => $idTeamUnit,
        //         'device_dismantle' => $pelepasan_perangkat,
        //         'server_device' => $serverDevice
                
        //     ]);
        // }catch(Exception $e){
        //     return redirect('/staff/layanan/pelepasan-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceDismantle $deviceDismantle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceDismantleRequest $request, DeviceDismantle $deviceDismantle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceDismantle $deviceDismantle)
    {
        //
    }

    public function deviceDismantleJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $device_dismantles = DeviceDismantle::with(['team_unit', 'user'])->select([
            'device_dismantles.id',
            'device_dismantles.id_user',
            'device_dismantles.id_team_unit',

            'device_dismantles.created_at',
            'device_dismantle_registration_id',
            'device_dismantle_acceptance_status',
            
            'users.user_full_name',
            'users.user_nip',
        ])->join('team_units', 'device_dismantles.id_team_unit', '=', 'team_units.id')
          ->join('users', 'device_dismantles.id_user', '=', 'users.id')
          ->where('device_dismantles.id_team_unit', '=', $idTeamUnit)
          ->orderBy('device_dismantles.created_at', 'desc'); 
          
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_dismantles)->make(true);
    }
}
