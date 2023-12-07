<?php

namespace App\Http\Controllers\main_administrator_controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeviceBrand;
use App\Models\DeviceType;
use App\Models\TeamUnit;

class DashboardController extends Controller
{
    public function index()
    {
        return view('main-administrator-layouts.dashboard', [
            'title' => 'Dashboard Meta',
        ]);
    }

    public function master()
    {
        return view('main-administrator-layouts.master.index', [
            'title' => 'Dashboard Master',
            'countUsers' => User::count(),
            'countDeviceTypes' => DeviceType::count(),
            'countDeviceBrands' => DeviceBrand::count(),
            'countTeamUnits' => TeamUnit::count()
        ]);
    }

    public function pendataan()
    {
        return view('main-administrator-layouts.pendataan-perangkat-jaringan.index', [
            'title' => 'Dashboard Pendataan Perangkat Jaringan',
        ]);
    }

    public function layanan()
    {
        return view('main-administrator-layouts.layanan-data-center.index', [
            'title' => 'Dashboard Layanan Data Center',
        ]);
    }
}
