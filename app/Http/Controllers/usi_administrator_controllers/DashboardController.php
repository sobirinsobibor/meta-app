<?php

namespace App\Http\Controllers\usi_administrator_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('usi-administrator-layouts.dashboard', [
            'title' => 'Dashboard Meta',
        ]);
    }

    public function pendataan()
    {
        return view('usi-administrator-layouts.pendataan-perangkat-jaringan.index', [
            'title' => 'Dashboard Pendataan Perangkat Jaringan',
        ]);
    }

    public function layanan()
    {
        return view('usi-administrator-layouts.layanan-data-center.index', [
            'title' => 'Dashboard Layanan Data Center',
        ]);
    }

    public function dokumentasi()
    {
        return view('usi-administrator-layouts.dokumentasi.index', [
            'title' => 'Dashboard Layanan Data Center',
        ]);
    }


}
