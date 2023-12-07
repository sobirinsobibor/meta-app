<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class SwitchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.switch.index', [
            'title' => 'Halaman Pendataan Perangkat Switch',
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {

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
    public function update(Request $request, Device $device)
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

    public function switchJson(){
        $switch_id_device_type = 3;
        $switches = Device::with(['device_type', 'device_brand', 'team_unit', 'menu'])->select([
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
          ->where('devices.id_device_type', '=', $switch_id_device_type)
          ->orderBy('devices.id', 'asc'); 
    
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($switches)->make(true);

    }

    
}
