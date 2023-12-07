<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\DeviceBrand;
use App\Http\Requests\StoreDeviceBrandRequest;
use App\Http\Requests\UpdateDeviceBrandRequest;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\Datatables\Datatables;

class DeviceBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.device_brand_views.index', [
            'title' => 'Halaman Merk Perangkat'
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
    public function store(StoreDeviceBrandRequest $request)
    {
        try{
            $validatedData = $request->validate([
                'device_brand_name' => 'required',
                'device_brand_active_status' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            DeviceBrand::create($validatedData);

            return redirect('/admin/master/merk-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/admin/master/merk-perangkat')->with('message', ['text' => 'Device Brand not found', 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceBrand $deviceBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceBrand $deviceBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceBrandRequest $request, DeviceBrand $deviceBrand)
    {
        try{
            $validatedData = $request->validate([
                'device_brand_name' => 'required',
                'device_brand_active_status' => 'required',
            ]);
    
            $deviceBrand_update = DeviceBrand::find($request->device_brand_id);
            if (!$deviceBrand_update) {
                return redirect('/admin/master/merk-perangkat')->with('message', ['text' => 'Device Brand not found', 'class' => 'danger']);
            }
            
            $deviceBrand_update->update($validatedData);
            return redirect('/admin/master/merk-perangkat')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(Exception $e){
            return redirect('/admin/master/merk-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceBrand $deviceBrand)
    {
        //
    }

    //datatable
    public function deviceBrandJson(){
        $device_brands = DeviceBrand::select([
                'device_brands.id',
                'device_brand_name',
                'device_brand_active_status'
            ])->orderBy('device_brands.device_brand_name', 'asc'); 
        
                // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_brands)->make(true);
    }
    
}
