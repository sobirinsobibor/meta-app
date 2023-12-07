<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
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
    public function store(StoreFileRequest $request)
    {
        // Validasi file yang diunggah
        // $request->validate([
        //     'file' => 'required|mimes:jpg,png,pdf|max:5120', // Sesuaikan dengan jenis file yang diterima
        // ]);

        // $registration_id = $request->input('registration_id');
        // $idTeamUnit = $request->input('id_team_unit');

        // $count = File::where('file_registration_id', '=', $registration_id)->count();
        // $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);
        
        // $file = $request->file('file');
        // $fileName = $registration_id . '_' . $formattedCount . '_' . $file->getClientOriginalName();
        // $fileExtension = $file->getClientOriginalExtension();

        // $rules = [
        //     'file_registration_id' => $registration_id,
        //     'file_name' => $fileName,
        //     'file_extension' => $fileExtension,
        //     'created_at' => time(),
        //     'updated_at' => time(),
        //     'id_team_unit' => $idTeamUnit
        // ];

        // File::create($rules);
        // $file->storeAs('/files', $fileName);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $file)
    {
       
    }
}
