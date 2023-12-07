<?php

use Illuminate\Support\Facades\Route;

//main-administrator-controller
use App\Http\Controllers\main_administrator_controllers\APWifiController as adminAPWifiController;
use App\Http\Controllers\main_administrator_controllers\DashboardController as adminDashboardController;
use App\Http\Controllers\main_administrator_controllers\DeviceController as adminDeviceController;
use App\Http\Controllers\main_administrator_controllers\NetworkTopologyController as adminNetworkTopologyController;
use App\Http\Controllers\main_administrator_controllers\RouterController as adminRouterController;
use App\Http\Controllers\main_administrator_controllers\ServerController as adminServerController;
use App\Http\Controllers\main_administrator_controllers\SwitchController as adminSwitchController;
use App\Http\Controllers\main_administrator_controllers\WifiMappingController as adminWifiMappingController;

$sub_administrator_url = 'pendataan';

//pendataan-perangkat-jaringan
Route::get('/'.$main_administrator_url.'/'.$sub_administrator_url, [adminDashboardController::class, 'pendataan'])->name('admin.pendataan');

//pendataan-perangkat-jaringan.perangkat
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/perangkat', adminDeviceController::class)->names([
    'index' => $main_administrator_url.'.pendataan.perangkat'
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/perangkat/searchMenu/{idMenu}/{deviceRegistrationId}', [adminDeviceController::class, 'searchMenu']);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/devicejson', [adminDeviceController::class, 'deviceJson']);

//pendataan-perangkat/switch
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/switch', adminSwitchController::class)->names([
    'index' => $main_administrator_url.'.pendataan.switch'
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/switchjson', [adminSwitchController::class, 'switchJson']);

//pendataan-perangkat/router
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/router', adminRouterController::class)->names([
    'index' => $main_administrator_url.'.pendataan.router'
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/routerjson', [adminRouterController::class, 'routerJson']);

//pendataan-perangkat/ap_wifi
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/ap-wifi', adminAPWifiController::class)->names([
    'index' => $main_administrator_url.'.pendataan.ap-wifi'
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/apwifijson', [adminAPWifiController::class, 'APWifiJson']);

//pendataan-perangkat/server
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/server', adminServerController::class)->names([
    'index' => $main_administrator_url.'.pendataan.server'
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/serverjson', [adminServerController::class, 'serverJson']);

//pendataan-perangkat-jaringan.topologi-jaringan
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/topologi-jaringan', adminNetworkTopologyController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.topologi-jaringan',
    'show' => $main_administrator_url.'.'.$sub_administrator_url.'.topologi-jaringan.show',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/networktopologijson', [adminNetworkTopologyController::class, 'networkTopologyJson']);

//pendataan-perangkat-jaringan.mapping-wifi
Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/mapping-wifi', adminWifiMappingController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.mapping-wifi',
    'show' => $main_administrator_url.'.'.$sub_administrator_url.'.mapping-wifi.show',

]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/mappingwifijson', [adminWifiMappingController::class, 'mappingWifiJson']);

?>