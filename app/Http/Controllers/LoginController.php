<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        
        $credentials = $request->validate(
            [
                "user_nip" => 'required|numeric',
                "password" => 'required'
            ],       
        );

        if(Auth::attempt(['user_nip' => $credentials['user_nip'], 'password' => $credentials['password'], 'id_role' => 1, 'user_active_status' => true])){
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }else if(Auth::attempt(['user_nip' => $credentials['user_nip'], 'password' => $credentials['password'], 'id_role' => 2, 'user_active_status' => true])){
            $request->session()->regenerate();
            return redirect()->intended('/staff');
        }else if(Auth::attempt(['user_nip' => $credentials['user_nip'], 'password' => $credentials['password'], 'id_role' => 3, 'user_active_status' => true])){
            $request->session()->regenerate();
            return redirect()->intended('/visitor');
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
