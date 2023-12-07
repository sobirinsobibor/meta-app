<?php

namespace App\Http\Controllers\main_administrator_controllers;

use Exception;
use App\Models\DeviceCategory;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviceCategoryRequest;
use App\Http\Requests\UpdateDeviceCategoryRequest;

class DeviceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.device_category_views.index', [
            'title' => 'Halaman Kategori Perangkat'
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
    public function store(StoreDeviceCategoryRequest $request)
    {
        try{
            $validatedData = $request->validate([
                'device_category_name' => 'required',
                'device_category_active_status' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            DeviceCategory::create($validatedData);

            return redirect('/admin/master/kategori-perangkat')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/admin/master/kategori-perangkat')->with('message', ['text' => 'Error', 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceCategory $deviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceCategory $deviceCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceCategoryRequest $request, DeviceCategory $deviceCategory)
    {
        try{
            $validatedData = $request->validate([
                'device_category_name' => 'required',
                'device_category_active_status' => 'required',
            ]);
    
            $deviceCategory_update = DeviceCategory::find($request->device_category_id);
            if (!$deviceCategory_update) {
                return redirect('/admin/master/kategori-perangkat')->with('message', ['text' => 'Device Category not found', 'class' => 'danger']);
            }
            
            $deviceCategory_update->update($validatedData);
            return redirect('/admin/master/kategori-perangkat')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(Exception $e){
            return redirect('/admin/master/kategori-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceCategory $deviceCategory)
    {
        //
    }

    public function deviceCategoryJson(){
        $device_categories = DeviceCategory::select([
                'device_categories.id',
                'device_category_name',
                'device_category_active_status'
            ])->orderBy('device_categories.device_category_name', 'asc'); 
        
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($device_categories)->make(true);
    }
}
