<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        if(Auth::user()->id_role === 1){
            return redirect()->intended('/admin');
        }
        elseif(Auth::user()->id_role === 2){
            return redirect()->intended('/staff');
        }
        elseif(Auth::user()->id_role === 3){
            return redirect()->intended('/visitor');
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', [
            'title' => 'Halaman Profile',
            'user' => $user
        ]);
    }

    protected function makeRegistrationId($components){
        $regsitration_id = '';
        $id_team_unit = $components['id_team_unit'];
        $id_menu = $components['id_menu'];
        $created_at = $components['date'];
        $model = $components['model'];

        // Check the length of $id_team_unit and $id_menu
        if (strlen($id_team_unit) < 2) {
            $id_team_unit = str_pad($id_team_unit, 2, '0', STR_PAD_LEFT);
        } elseif (strlen($id_team_unit) > 2) {
            return false;
        }

        if (strlen($id_menu) < 2) {
            $id_menu = str_pad($id_menu, 2, '0', STR_PAD_LEFT);
        } elseif (strlen($id_menu) > 2) {
            return false;
        }

        $count = $model::whereDate('created_at', '=', $created_at)
            ->where('id_team_unit', $components['id_team_unit'] )
            ->count();
        $formattedCount = str_pad($count+1, 3, '0', STR_PAD_LEFT);
        
        $formattedCreated_at = date('Ymd', strtotime(str_replace('/','-', $created_at)));

        $regsitration_id = $formattedCreated_at.$id_team_unit.$id_menu.$formattedCount;

        return $regsitration_id;
    }

    public function uploadFile($request, $data)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:5120',
        ]);

        $regsitration_id = $data['registration_id'];
        $idTeamUnit = $data['id_team_unit'];

        
        $file = $request->file('file');
        $fileName = $regsitration_id . '_' . $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();

        $rules = [
            'file_registration_id' => $regsitration_id,
            'file_name' => $fileName,
            'file_extension' => $fileExtension,
            'created_at' => time(),
            'updated_at' => time(),
            'id_team_unit' => $idTeamUnit
        ];

        File::create($rules);
        $file->storeAs('/files', $fileName);
    }

    protected function renameFile($fileName){
        // Mengambil ekstensi dari nama file lengkap
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Menghapus ekstensi dari nama file lengkap
        $originalFileName = pathinfo($fileName, PATHINFO_FILENAME);

        // Mengganti spasi dan karakter "+" dengan garis bawah
        $formattedFileName = Str::slug($originalFileName, '_');

        // Mengonversi semua huruf menjadi huruf kecil
        $formattedFileName = strtolower($formattedFileName);

        // Menggabungkan nama file yang telah diformat dengan ekstensi asli
        $newFileName = $formattedFileName . '.' . $extension;

        return $newFileName;    
    }
}
