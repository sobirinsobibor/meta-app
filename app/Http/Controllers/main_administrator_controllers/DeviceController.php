<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\Device;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.index', [
            'title' => 'Halaman Pendataan Perangkat',
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
    public function store(StoreDeviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }

    public function deviceJson(){
        $device_brands = Device::with(['device_type', 'device_brand', 'team_unit', 'menu'])->select([
            'devices.id',
            'devices.device_registration_id',
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
          ->orderBy('devices.id', 'asc'); 
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
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
