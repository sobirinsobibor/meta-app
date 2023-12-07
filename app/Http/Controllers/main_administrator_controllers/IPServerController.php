<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\IPServer;
use App\Http\Requests\StoreIPServerRequest;
use App\Http\Requests\UpdateIPServerRequest;
use App\Http\Controllers\Controller;

class IPServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreIPServerRequest $request)
    {
        try{
            $validatedData = $request->validate([
                'ip_server_name' => 'required',
                'ip_server_manage_name' => 'required',
                'device_registration_id' => 'required'
            ]);
            IPServer::create($validatedData);
            return redirect('/admin/layanan/instalasi-perangkat/')->with('message', ['text' => 'Success', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('/admin/layanan/instalasi-perangkat/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(IPServer $iPServer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IPServer $iPServer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIPServerRequest $request, IPServer $iPServer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IPServer $iPServer)
    {
        //
    }
}
