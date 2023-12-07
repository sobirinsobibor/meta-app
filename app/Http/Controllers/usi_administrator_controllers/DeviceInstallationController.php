<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Exception;
use App\Models\File;
use App\Models\Device;
use App\Models\IPServer;
use App\Models\ServerType;

use App\Models\DeviceBrand;
use App\Models\MemoryServer;
use App\Models\DeviceCategory;
use App\Models\HardDiskServer;
use App\Models\ServerFunction;
use App\Models\ProcessorServer;
use Yajra\Datatables\Datatables;
use App\Models\DeviceInstallation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailIdentityServer;
use App\Http\Requests\StoreDeviceInstallationRequest;
use App\Http\Requests\UpdateDeviceInstallationRequest;

class DeviceInstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.layanan-data-center.instalasi-perangkat.index', [
            'title' => 'Halaman Instalasi Perangkat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deviceBrands = DeviceBrand::select('id', 'device_brand_name')
        ->orderBy('device_brand_name')->get();
        $deviceCategories = DeviceCategory::select('id', 'device_category_name')
        ->orderBy('device_category_name')->get();
        $ServerTypes = ServerType::select('id', 'server_type_name')
        ->orderBy('server_type_name')->get();
        $serverFunctions = ServerFunction::select('id', 'server_function_name')
        ->orderBy('server_function_name')->get();

        return view('usi-administrator-layouts.layanan-data-center.instalasi-perangkat.create', [
            'title' => 'Halaman Tambah Instalasi Perangkat',
            'deviceBrands' => $deviceBrands,
            'deviceCategories' => $deviceCategories,
            'serverTypes' => $ServerTypes,
            'serverFunctions' => $serverFunctions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceInstallationRequest $request)
    {
        try{
            //making device installation registration id
            $components_device_installation = [
                'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
                'id_team_unit' => $request->id_team_unit,
                'id_menu' => "4",
                'model' => 'App\Models\DeviceInstallation'
            ];
            $device_installations_registration_id = $this->makeRegistrationId($components_device_installation);

            //making device registration id
            $components_device = [
                'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
                'id_team_unit' => $request->id_team_unit,
                'id_menu' => "1",
                'model' => 'App\Models\Device'
            ];
            $device_registration_id = $this->makeRegistrationId($components_device);

            //validated Data for device
            $validatedData_device = $request->validate([
                'device_name' => 'required',
                'device_purchase_year' => 'required|integer|digits:4',
                'device_description' => 'required|max:151',
                'id_device_brand' => 'required',
                'id_team_unit' => 'required',
            ]);
            $validatedData_device['device_registration_id'] = $device_registration_id;
            $validatedData_device['device_active_status'] = 0;
            $validatedData_device['id_device_type'] = 2; //-> ganti 2 karena otomatis server 
            $validatedData_device['id_menu'] = 4; //-> kasih 4 karena dia masuk lewat jalur permohonan instalasi bukan didata sendiri  
            $validatedData_device['created_at'] = now();
            $validatedData_device['updated_at'] = now();

            //validated Data for Hard Disk
            $validatedData_hard_disk = $request->validate([
                'hard_disk_amount_of_piece' => 'required',
                'hard_disk_capacity_of_piece' => 'required'
            ]);
            $validatedData_hard_disk['device_registration_id'] = $device_registration_id;
            $validatedData_hard_disk['created_at'] = now();
            $validatedData_hard_disk['updated_at'] = now();

            //validated Data for Memory
            $validatedData_memory = $request->validate([
                'memory_amount_of_piece' => 'required',
                'memory_capacity_of_piece' => 'required',
            ]);
            $validatedData_memory['device_registration_id'] = $device_registration_id;
            $validatedData_memory['created_at'] = now();
            $validatedData_memory['updated_at'] = now();

            //validated Data for processor
            $validatedData_processor = $request->validate([
                'processor_amount_of_piece' => 'required',
                'processor_amount_of_core' => 'required'
            ]);
            $validatedData_processor['device_registration_id'] = $device_registration_id;
            $validatedData_processor['created_at'] = now();
            $validatedData_processor['updated_at'] = now();

            //validated Data for device installation
            $validatedData_device_installation = $request->validate([
                'user_nip' => 'required',
                'id_team_unit' => 'required',
                'id_user' => 'required',
                'file' => 'required|mimes:jpg,png,pdf|max:5120',
            ]);
            $file = $request->file('file');
            $validatedData_device_installation['device_installation_acceptance_status'] = 2;
            $validatedData_device_installation['device_installation_registration_id'] =  $device_installations_registration_id;
            $validatedData_device_installation['device_registration_id'] =  $device_registration_id;
            $validatedData_device_installation['created_at'] = now();
            $validatedData_device_installation['updated_at'] = now();

            $validatedData_device_installation['device_installation_file_name'] = $validatedData_device_installation['device_installation_registration_id'] . '_' . $this->renameFile($file->getClientOriginalName());
            
            $validatedData_device_installation['device_installation_file_extension'] = $file->getClientOriginalExtension();

            $validatedData_detail_identity_server = $request->validate([
                'id_device_category' => 'required',
                'id_server_type' => 'required',
                'id_server_function' => 'required'
            ]);
            $validatedData_detail_identity_server['device_registration_id'] = $device_registration_id;
            $validatedData_detail_identity_server['created_at'] = now();
            $validatedData_detail_identity_server['updated_at'] = now();
            $validatedData_detail_identity_server['server_function_name'] = $request->id_server_function;
            try {
                DB::beginTransaction();
            
                Device::create($validatedData_device);
                ProcessorServer::create($validatedData_processor);
                MemoryServer::create($validatedData_memory);
                HardDiskServer::create($validatedData_hard_disk);
                DeviceInstallation::create($validatedData_device_installation);
                DetailIdentityServer::create($validatedData_detail_identity_server);
                $file->storeAs('/files', $validatedData_device_installation['device_installation_file_name']);
                // Jika semua perintah berhasil, konfirmasikan transaksi
                DB::commit();
            } catch (\Exception $e) {
                // Jika terjadi kesalahan, batalkan transaksi
                DB::rollback();
                return redirect('/staff/layanan/instalasi-perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
            }

            return redirect('/staff/layanan/instalasi-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(Exception $e){
            return redirect('/staff/layanan/instalasi-perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

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
            return view('usi-administrator-layouts.layanan-data-center.instalasi-perangkat.detail', [
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
            return redirect('/user/layanan/instalasi-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

        // try{
        //     $user = auth()->user(); 
        //     $idTeamUnit = $user->id_team_unit;
    
        //     if ($instalasi_perangkat->id_team_unit !== $idTeamUnit) {
        //         return redirect('/staff/layanan/instalasi-perangkat/')->with('message', ['text' => 'Anda tidak memiliki izin untuk melihat dokumen', 'class' => 'danger']);
        //     }
    
        //     if ($instalasi_perangkat->id_team_unit !== $idTeamUnit) {
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
        //       ->where('devices.device_registration_id', '=', $instalasi_perangkat->device_registration_id)
        //       ->first(); 

        
        //     $registration_id = $instalasi_perangkat->device_installation_registration_id;
        //     return view('usi-administrator-layouts.layanan-data-center.instalasi-perangkat.detail', [
        //         'title' => "Halaman Instalasi Perangkat",
        //         "registration_id" => $registration_id,
        //         'id_team_unit' => $idTeamUnit,
        //         'device_installation' => $instalasi_perangkat,
        //         'server_device' => $serverDevice
        //     ]);
        // }catch(Exception $e){
        //     return redirect('/staff/layanan/instalasi-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        // }

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
    public function update(UpdateDeviceInstallationRequest $request, DeviceInstallation $deviceInstallation)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceInstallation $deviceInstallation)
    {
        //
    }

    public function deviceInstallationJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $device_installations = DeviceInstallation::with(['team_unit', 'user'])->select([
            'device_installations.id',
            'device_installations.id_user',
            'device_installations.id_team_unit',

            'device_installations.created_at',
            'device_installation_registration_id',
            'device_installation_acceptance_status',
            
            'users.user_full_name',
            'users.user_nip',
        ])->join('team_units', 'device_installations.id_team_unit', '=', 'team_units.id')
          ->join('users', 'device_installations.id_user', '=', 'users.id')
          ->where('device_installations.id_team_unit', '=', $idTeamUnit)
          ->orderBy('device_installations.created_at', 'desc'); 
          
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_installations)->make(true);
    }
}
