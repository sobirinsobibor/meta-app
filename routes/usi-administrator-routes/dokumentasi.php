<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usi_administrator_controllers\DashboardController as usiDashboardController;

$sub_administrator_url = 'dokumentasi';

//pendataan-perangkat-jaringan
Route::get('/'.$usi_administrator_url.'/'.$sub_administrator_url, [usiDashboardController::class, 'dokumentasi'])->name($usi_administrator_url.'.dokumentasi');

Route::get('/staff/dokumentasi/user-manual', function () {
    return view('usi-administrator-layouts.dokumentasi.user-manual.index', [
        'title' => "Halaman User Manual"
    ]);
})->name('staff.dokumentasi.user-manual');;

Route::get('/staff/dokumentasi/maps', function () {
    return view('usi-administrator-layouts.dokumentasi.maps.index', [
        'title' => "Halaman maps"
    ]);
})->name('staff.dokumentasi.maps');;