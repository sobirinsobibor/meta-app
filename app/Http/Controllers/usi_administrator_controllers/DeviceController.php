<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Exception;
use App\Models\Device;
use App\Models\DeviceType;
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
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.index', [
            'title' => 'Halaman Pendataan Perangkat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deviceTypes = DeviceType::select('id', 'device_type_name')
        ->orderBy('device_type_name')->get();
        $deviceBrands = DeviceBrand::select('id', 'device_brand_name')
        ->orderBy('device_brand_name')->get();
        $ServerTypes = ServerType::select('id', 'server_type_name')
        ->orderBy('server_type_name')->get();
        $serverFunctions = ServerFunction::select('id', 'server_function_name')
        ->orderBy('server_function_name')->get();
        $deviceCategories = DeviceCategory::select('id', 'device_category_name')
        ->orderBy('device_category_name')->get();

        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.create', [
            'title' => 'Halaman Tambah Data Perangkat',
            'deviceTypes' => $deviceTypes,
            'deviceBrands' => $deviceBrands,
            'serverTypes' => $ServerTypes,
            'serverFunctions' => $serverFunctions,
            'deviceCategories' => $deviceCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request)
    {
        // dd($request);
        //making id
        $components = [
            'date' => date('Y-m-d', strtotime(str_replace('/','-', now()))),
            'id_team_unit' => $request->id_team_unit,
            'id_menu' => "1",
            'model' => 'App\Models\Device'
        ];
        
        if($request->id_device_type == 2){ //kalo dia server
            try{
    
                $device_registration_id = $this->makeRegistrationId($components);
    
                //validated Data for device
                $validatedData_device = $request->validate([
                    'device_name' => 'required',
                    'device_purchase_year' => 'required|integer|digits:4',
                    'device_description' => 'required|max:151',
                    'id_device_brand' => 'required',
                    'id_team_unit' => 'required',
                    'id_device_type' => 'required',
                    'device_active_status' => 'required',
                ]);
                $validatedData_device['device_registration_id'] = $device_registration_id;
                $validatedData_device['id_menu'] = 1;
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
                    DetailIdentityServer::create($validatedData_detail_identity_server);
                    // Jika semua perintah berhasil, konfirmasikan transaksi
                    DB::commit();
                } catch (\Exception $e) {
                    // Jika terjadi kesalahan, batalkan transaksi
                    DB::rollback();
                    return redirect('/staff/pendataan/perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
                }
    
                return redirect('/staff/pendataan/perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);
            }catch(Exception $e){
                return redirect('/staff/pendataan/perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
            }
    
        }else{
            try{
                $validatedData = $request->validate([
                    'device_name' => 'required',
                    'device_purchase_year' => 'required|integer|digits:4',
                    'device_description' => 'required|max:151',
                    'device_active_status' => 'required',
                    'id_device_type' => 'required',
                    'id_device_brand' => 'required',
                    'id_team_unit' => 'required',
                ]);
                $validatedData['created_at'] = now();
                $validatedData['updated_at'] = now();
                $validatedData['id_menu'] = 1;
    
                $validatedData['device_registration_id'] = $this->makeRegistrationId($components);
    
                Device::create($validatedData);
                return redirect('/staff/pendataan/perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);
            }catch(Exception $e){
                return redirect('/staff/pendataan/perangkat/create')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $perangkat)
    {
        // dd($perangkat->device_registration_id);
        if($perangkat->id_device_type == 2){ //kalo dia server
            $server_processors = ProcessorServer::select([
                'processor_amount_of_piece',
                'processor_amount_of_core'
            ])->where('device_registration_id', '=', $perangkat->device_registration_id)
              ->first();
 
            $server_memories = MemoryServer::select([
                'memory_amount_of_piece',
                'memory_capacity_of_piece'
            ])->where('device_registration_id', '=', $perangkat->device_registration_id)
              ->first();
            
            $server_hard_disks = HardDiskServer::select([
                'hard_disk_amount_of_piece',
                'hard_disk_capacity_of_piece'
            ])->where('device_registration_id', '=', $perangkat->device_registration_id)
              ->first();

            $detail_identity_server = DetailIdentityServer::with(['server_type', 'device_category'])->select([
                'server_function_name',
                'server_types.server_type_name',
                'device_categories.device_category_name'
            ])->join('server_types', 'detail_identity_servers.id_server_type', '=', 'server_types.id')
              ->join('device_categories', 'detail_identity_servers.id_device_category', '=', 'device_categories.id')
              ->first();
            
            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;
            return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.detail', [
                'title' => 'Halaman Detail Data Perangkat',
                'id_team_unit' => $idTeamUnit,
                'device' => $perangkat,
                'detail_identity_server' => $detail_identity_server,
                'server_hard_disks' => $server_hard_disks,
                'server_memories' => $server_memories,
                'server_processors' => $server_processors  
            ]);

        }else{
            
        }

        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.detail', [
            'title' => 'Halaman Tambah Data Perangkat',
            'device' => $perangkat,

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $perangkat)
    {
        try {
            $deviceTypes = DeviceType::select('id', 'device_type_name')
            ->orderBy('device_type_name')->get();
            $deviceBrands = DeviceBrand::select('id', 'device_brand_name')
            ->orderBy('device_brand_name')->get();

            $user = auth()->user(); 
            $idTeamUnit = $user->id_team_unit;
            if ($perangkat->id_team_unit === $idTeamUnit && $perangkat->id_menu == 1) {
                return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.edit', [
                    'title' => 'Halaman Edit Perangkat Jaringan',
                    'device' => $perangkat,
                    'deviceTypes' => $deviceTypes,
                    'deviceBrands' => $deviceBrands,        
                ]);
            } else {
                return redirect('/staff/pendataan/perangkat/')->with('message', ['text' => 'Anda tidak memiliki izin untuk mengedit perangkat', 'class' => 'danger']);
            }
        } catch (\Exception $e) {
            return redirect('/staff/pendataan/perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $perangkat)
    {
        try{
            $validatedData = $request->validate([
                'device_name' => 'required',
                'devices.device_registration_id',
                'device_purchase_year' => 'required|integer|digits:4',
                'device_description' => 'required|max:151',
                'device_active_status' => 'required',
                'id_device_type' => 'required',
                'id_device_brand' => 'required',
                'id_team_unit' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            $device_update = Device::find($perangkat->device_registration_id);
            if (!$device_update) {
                return redirect('/staff/pendataan/perangkat')->with('message', ['text' => 'Device not found', 'class' => 'danger']);
            }
            
            $device_update->update($validatedData);
            return redirect('/staff/pendataan/perangkat')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(Exception $e){
            return redirect('/staff/pendataan/perangkat/'.$perangkat->id.'/edit')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }

    public function deviceJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $device_brands = Device::with(['device_type', 'device_brand', 'team_unit', 'menu'])->select([
            'devices.device_registration_id',
            'devices.id',
            'device_name',
            'device_purchase_year',
            'device_description',
            'device_active_status',
            'devices.id_menu',
            'device_types.device_type_name',
            'device_brands.device_brand_name',
            'device_active_status',
            'team_units.team_unit_name',
            'menus.menu_name'
        ])->join('device_types', 'devices.id_device_type', '=', 'device_types.id')
          ->join('device_brands', 'devices.id_device_brand', '=', 'device_brands.id')
          ->join('team_units', 'devices.id_team_unit', '=', 'team_units.id')
          ->join('menus', 'devices.id_menu', '=', 'menus.id')
          ->where('devices.id_team_unit', '=', $idTeamUnit)
          ->orderBy('devices.id', 'asc'); 
    
        return Datatables::of($device_brands)->make(true);

    }

    public function searchMenu($idMenu, $deviceRegistrationId){
        
        $model ='';
        $variable ='';

        if ($idMenu == 4) {
            $model = \App\Models\DeviceInstallation::class;
            $variable = 'device_installation';
        } elseif ($idMenu == 5) {
            $model = \App\Models\DeviceMaintenance::class;
            $variable = 'device_maintenance';
        } elseif ($idMenu == 6) {
            $model = \App\Models\DeviceDismantle::class;
            $variable = 'device_dismantle';
        }

        
        // query
        $service = $model::select([
                    $variable.'_registration_id',
                    $variable.'_booking_date'
                ])->where('device_registration_id', '=', $deviceRegistrationId)
                  ->latest('created_at')
                  ->first();
        
        if ($service) {
            // Data berhasil ditemukan, kirimkannya sebagai respons JSON
            return response()->json($service);
        } else {
            // Data tidak ditemukan
            return response()->json(['message' => 'Data Layanan tidak ditemukan'], 404);
        }
    }

}
