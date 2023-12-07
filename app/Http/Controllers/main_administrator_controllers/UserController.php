<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $table = 'users';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.user_views.index', [
            'title' => 'Halaman Pegawai',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validate([
            'user_active_status' => 'required',
        ]);

        $user_update = User::find($request->user_id);
        if (!$user_update) {
            return redirect('/admin/master/user')->with('message', ['text' => 'User not found', 'class' => 'danger']);
        }
        
        $user_update->update($validatedData);
        return redirect('/admin/master/user')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        echo 'test';

    }

    //datatable
    public function userJson()
    {
        $users = User::with(['role', 'team_unit'])->select([
            'users.id',
            'user_nip',
            'user_full_name',
            'user_email', 
            'user_phone', 
            'user_active_status',
            'roles.role_name', 
            'team_units.team_unit_name',
            ])->join('roles', 'users.id_role', '=', 'roles.id')
              ->join('team_units', 'users.id_team_unit', '=', 'team_units.id')
              ->orderBy('users.id', 'asc'); 
        
               // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($users)->make(true);
    }

}
