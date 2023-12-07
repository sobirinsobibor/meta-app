<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\main_administrator_controllers\DashboardController as adminDashboardController;
use App\Http\Controllers\main_administrator_controllers\DeviceDismantleController as adminDeviceDismantleController;
use App\Http\Controllers\main_administrator_controllers\DeviceInstallationController as adminDeviceInstallationController;
use App\Http\Controllers\main_administrator_controllers\DeviceMaintenanceController as adminDeviceMaintenanceController;

$sub_administrator_url = 'layanan';

//pendataan-perangkat-jaringan
Route::get('/'.$main_administrator_url.'/'.$sub_administrator_url, [adminDashboardController::class, 'layanan'])->name($main_administrator_url.'.layanan');

//layanan-data-center.instalasi-perangkat
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/instalasi-perangkat', adminDeviceInstallationController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.instalasi-perangkat',
    'show' => $main_administrator_url.'.'.$sub_administrator_url.'.instalasi-perangkat.show',
    'update' => $main_administrator_url.'.'.$sub_administrator_url.'.instalasi-perangkat.update',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/deviceinstallationjson', [adminDeviceInstallationController::class, 'deviceInstallationJson']);

//layanan-data-center.pemeiliharaan-perangkat
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/pemeliharaan-perangkat', adminDeviceMaintenanceController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.pemeliharaan-perangkat',
    'show' => $main_administrator_url.'.'.$sub_administrator_url.'.pemeliharaan-perangkat.show',
    'update' => $main_administrator_url.'.'.$sub_administrator_url.'.pemeliharaan-perangkat.update',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/devicemaintenancejson', [adminDeviceMaintenanceController::class, 'deviceMaintenanceJson']);

//layanan-data-center.pelepasan-perangkat
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/pelepasan-perangkat', adminDeviceDismantleController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.pelepasan-perangkat',
    'show' => $main_administrator_url.'.'.$sub_administrator_url.'.pelepasan-perangkat.show',
    'update' => $main_administrator_url.'.'.$sub_administrator_url.'.pelepasan-perangkat.update',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/devicedismantlejson', [adminDeviceDismantleController::class, 'deviceDismantleJson']);

?>