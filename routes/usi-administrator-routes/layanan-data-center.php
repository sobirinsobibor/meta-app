<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\usi_administrator_controllers\DashboardController as usiDashboardController;
use App\Http\Controllers\usi_administrator_controllers\DeviceDismantleController as usiDeviceDismantleController;
use App\Http\Controllers\usi_administrator_controllers\DeviceInstallationController as usiDeviceInstallationController;
use App\Http\Controllers\usi_administrator_controllers\DeviceMaintenanceController as usiDeviceMaintenanceController;

$sub_administrator_url = 'layanan';

//pendataan-perangkat-jaringan
Route::get('/'.$usi_administrator_url.'/'.$sub_administrator_url, [usiDashboardController::class, 'layanan'])->name($usi_administrator_url.'.layanan');

//layanan-data-center.instalasi-perangkat
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/instalasi-perangkat', usiDeviceInstallationController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.instalasi-perangkat',
    'show' => $usi_administrator_url.'.'.$sub_administrator_url.'.instalasi-perangkat.show',
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/deviceinstallationjson', [usiDeviceInstallationController::class, 'deviceInstallationJson']);

//layanan-data-center.pemeiliharaan-perangkat
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/pemeliharaan-perangkat', usiDeviceMaintenanceController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.pemeliharaan-perangkat',
    'show' => $usi_administrator_url.'.'.$sub_administrator_url.'.pemeliharaan-perangkat.show',
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/devicemaintenancejson', [usiDeviceMaintenanceController::class, 'deviceMaintenanceJson']);

//layanan-data-center.pelepasan-perangkat
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/pelepasan-perangkat', usiDeviceDismantleController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.pelepasan-perangkat',
    'show' => $usi_administrator_url.'.'.$sub_administrator_url.'.pelepasan-perangkat.show',
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/devicedismantlejson', [usiDeviceDismantleController::class, 'deviceDismantleJson']);

?>