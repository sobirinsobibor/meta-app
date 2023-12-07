<?php

namespace App\Http\Controllers\main_administrator_controllers;
use App\Http\Controllers\Controller;
use App\Models\UpLink;
use App\Http\Requests\StoreUpLinkRequest;
use App\Http\Requests\UpdateUpLinkRequest;
use App\Models\UpLinkCapacity;
use App\Models\UpLinkTransmissionSpeed;
use App\Models\UpLinkType;
use Yajra\Datatables\Datatables;

class UpLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $up_link_types = UpLinkType::select([
            'up_link_type_name',
            'id'
        ])->orderBy('up_link_type_name', 'asc')->get();

        $up_link_capacities = UpLinkCapacity::select([
            'up_link_capacity_name',
            'id'
        ])->orderBy('up_link_capacity_name', 'asc')->get();
        
        $up_link_transmission_speeds = UpLinkTransmissionSpeed::select([
            'up_link_transmission_speed_name',
            'id'
        ])->orderBy('up_link_transmission_speed_name', 'asc')->get();
        return view('main-administrator-layouts.master.up_link_views.index', [
            'title' => 'Halaman Up Link',
            'up_link_types' => $up_link_types,
            'up_link_capacities' => $up_link_capacities,
            'up_link_transmission_speeds' => $up_link_transmission_speeds,
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
    public function store(StoreUpLinkRequest $request)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'id_up_link_type' => 'required',
                'id_up_link_capacity' => 'required',
                'id_up_link_transmission_speed' => 'required',
                'up_link_active_status' => 'required'
            ]);
            UpLink::create($validatedData);
            return redirect('admin/master/up-link')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('admin/master/up-link')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UpLink $upLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UpLink $upLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUpLinkRequest $request, UpLink $upLink)
    {
        try{
            $validatedData = $request->validate([
                'up_link_id' => 'required',
                'id_up_link_type' => 'required',
                'id_up_link_capacity' => 'required',
                'id_up_link_transmission_speed' => 'required',
                'up_link_active_status' => 'required'
            ]);
            $upLink_update = UpLink::find($request->up_link_id);
            if(!$upLink_update){
                return redirect('admin/master/up-link')->with('message', ['text' => 'Up Link not found', 'class' => 'danger']);
            }
            $upLink_update->update($validatedData);
            return redirect('admin/master/up-link')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('admin/master/up-link')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpLink $upLink)
    {
        //
    }

    public function upLinkJson(){
        $up_links = UpLink::with(['up_link_type', 'up_link_capacity', 'up_link_transmission_speed'])->select([
            
            'up_links.id as up_link_id', 
            'up_links.up_link_active_status',
            
            'up_link_types.id as up_link_type_id',
            'up_link_types.up_link_type_name',

            'up_link_capacities.id as up_link_capacity_id',
            'up_link_capacities.up_link_capacity_name',

            'up_link_transmission_speeds.id as up_link_transmission_speed_id',
            'up_link_transmission_speeds.up_link_transmission_speed_name'

        ])->join('up_link_types', 'up_links.id_up_link_type', '=', 'up_link_types.id')
          ->join('up_link_capacities', 'up_links.id_up_link_capacity', '=', 'up_link_capacities.id')
          ->join('up_link_transmission_speeds', 'up_links.id_up_link_transmission_speed', '=', 'up_link_transmission_speeds.id')
          ->orderBy('up_links.id_up_link_type', 'asc'); 

          return Datatables::of($up_links)->make(true);

    }
}
