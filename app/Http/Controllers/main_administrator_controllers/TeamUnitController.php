<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\TeamUnit;
use App\Http\Requests\StoreTeamUnitRequest;
use App\Http\Requests\UpdateTeamUnitRequest;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class TeamUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main-administrator-layouts.master.team_unit_views.index', [
            'title' => 'Halaman Unit Kerja'
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
    public function store(StoreTeamUnitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamUnit $teamUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamUnit $teamUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamUnitRequest $request, TeamUnit $teamUnit)
    {
        $validatedData = $request->validate([
            'team_unit_active_status' => 'required',
        ]);

        $teamUnit_update = TeamUnit::find($request->team_unit_id);
        if (!$teamUnit_update) {
            return redirect('/admin/master/unit-kerja')->with('message', ['text' => 'Unit Kerja not found', 'class' => 'danger']);
        }
        
        $teamUnit_update->update($validatedData);
        return redirect('/admin/master/unit-kerja')->with('message', ['text' => 'Data Successfully Updated', 'class' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamUnit $teamUnit)
    {
        //
    }

    public function teamUnitJson(){
        $team_units = TeamUnit::select([
            'team_units.id',
            'team_unit_name',
            'team_unit_active_status'
        ])->orderBy('team_units.team_unit_name', 'asc'); 
    
           // Debugging: Tampilkan nilai user_nip sebelum query dieksekusi
        return Datatables::of($team_units)->make(true);
    }
}
