<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\ServerType;
use App\Http\Requests\StoreServerTypeRequest;
use App\Http\Requests\UpdateServerTypeRequest;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ServerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.server_type_views.index', [
            'title' => 'Halaman Tipe Server'
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
    public function store(StoreServerTypeRequest $request)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'server_type_name' => 'required',
                'server_type_active_status' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            ServerType::create($validatedData);

            return redirect('/admin/master/tipe-server')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/admin/master/tipe-server')->with('message', ['text' => 'Error', 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ServerType $serverType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServerType $serverType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServerTypeRequest $request, ServerType $serverType)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'server_type_name' => 'required',
                'server_type_active_status' => 'required',
            ]);
    
            $servertype_update = ServerType::find($request->server_type_id);
            if (!$servertype_update) {
                return redirect('/admin/master/tipe-server')->with('message', ['text' => 'server type not found', 'class' => 'danger']);
            }
            
            $servertype_update->update($validatedData);
            return redirect('/admin/master/tipe-server')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('/admin/master/tipe-server/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServerType $serverType)
    {
        //
    }

    public function serverTypeJson(){
        $server_categories = ServerType::select([
                'server_types.id',
                'server_type_name',
                'server_type_active_status'
            ])->orderBy('server_types.server_type_name', 'asc'); 
        
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($server_categories)->make(true);
    }

}
