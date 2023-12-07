<?php

namespace App\Http\Controllers\visitor_controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('visitor-layouts.dashboard', [
            'title' => 'Dashboard Meta',
        ]);
    }
}
