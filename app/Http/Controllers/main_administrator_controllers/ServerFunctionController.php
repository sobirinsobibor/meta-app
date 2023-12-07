<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\ServerFunction;
use App\Http\Requests\StoreServerFunctionRequest;
use App\Http\Requests\UpdateServerFunctionRequest;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ServerFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.server_function_views.index', [
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
    public function store(StoreServerFunctionRequest $request)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'server_function_name' => 'required',
                'server_function_active_status' => 'required',
            ]);
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            ServerFunction::create($validatedData);

            return redirect('/admin/master/fungsi-server')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/admin/master/fungsi-server')->with('message', ['text' => 'Error', 'class' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ServerFunction $serverFunction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServerFunction $serverFunction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServerFunctionRequest $request, ServerFunction $serverFunction)
    {
        // dd($request);
        try{
            $validatedData = $request->validate([
                'server_function_name' => 'required',
                'server_function_active_status' => 'required',
            ]);
    
            $serverfunction_update = ServerFunction::find($request->server_function_id);
            if (!$serverfunction_update) {
                return redirect('/admin/master/fungsi-perangkat')->with('message', ['text' => 'server function not found', 'class' => 'danger']);
            }
            
            $serverfunction_update->update($validatedData);
            return redirect('/admin/master/fungsi-server')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
        }catch(\Exception $e){
            return redirect('/admin/master/fungsi-server/')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServerFunction $serverFunction)
    {
        //
    }

    public function serverFunctionJson(){
        $server_categories = ServerFunction::select([
                'server_functions.id',
                'server_function_name',
                'server_function_active_status'
            ])->orderBy('server_functions.server_function_name', 'asc'); 
        
        // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($server_categories)->make(true);
    }

}
