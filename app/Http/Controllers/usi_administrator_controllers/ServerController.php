<?php

namespace App\Http\Controllers\usi_administrator_controllers;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

use App\Models\Device;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.data-perangkat.server.index', [
            'title' => 'Halaman Pendataan Perangkat Server',
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

    public function serverJson(){
        $user = auth()->user(); 
        $idTeamUnit = $user->id_team_unit;
        $server_id_device_type = 1;
        $servers = Device::with(['device_type', 'device_brand', 'team_unit', 'menu'])->select([
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
          ->where('devices.id_device_type', '=', $server_id_device_type)
          ->orderBy('devices.id', 'asc'); 
    
        return Datatables::of($servers)->make(true);

    }

}
