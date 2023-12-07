<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\DeviceType;
use App\Http\Requests\StoreDeviceTypeRequest;
use App\Http\Requests\UpdateDeviceTypeRequest;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\Datatables\Datatables;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.device_type_views.index', [
            'title' => 'Halaman Jenis Perangkat'
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
    public function store(StoreDeviceTypeRequest $request)
    {
        try{
            $validatedData = $request->validate([
                'device_type_name' => 'required',
                'device_type_active_status' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            DeviceType::create($validatedData);

            return redirect('/admin/master/jenis-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/admin/master/jenis-perangkat')->with('message', ['text' => 'Device Type not found', 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceType $deviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceType $deviceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceTypeRequest $request, DeviceType $deviceType)
    {
        try{
            $validatedData = $request->validate([
                'device_type_name' => 'required',
                'device_type_active_status' => 'required',
            ]);
    
            $deviceType_update = DeviceType::find($request->device_type_id);
            if (!$deviceType_update) {
                return redirect('/admin/master/jenis-perangkat')->with('message', ['text' => 'Device Type not found', 'class' => 'danger']);
            }
            
            $deviceType_update->update($validatedData);
            return redirect('/admin/master/jenis-perangkat')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(Exception $e){
            return redirect('/admin/master/jenis-perangkat')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceType $deviceType)
    {
        //
    }

    //datatable
    public function deviceTypeJson(){
        $device_types = DeviceType::select([
                'device_types.id',
                'device_type_name',
                'device_type_active_status'
            ])->orderBy('device_types.device_type_name', 'asc'); 
        
               // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_types)->make(true);
    }
}
